<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\SoldProduct;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function addOrder(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required',
            'street' => 'required',
            'city' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'pay' => 'required|in:paypal,mastercard,visa,american express,discover',
        ]);

        // Get the user ID from the session
        $userId = $request->session()->get('user_id');

        // Get the cart items for the user
        $cartItems = Cart::where('user_id', $userId)->get();

        // Check if any product has insufficient quantity
        $insufficientProducts = [];
        foreach ($cartItems as $item) {
            $product = Product::find($item->product_id);
            if ($item->quantity > $product->quantity) {
                $insufficientProducts[] = $product->productName;
            }
        }

        // If there are any products with insufficient quantity, redirect with an error message
        if (count($insufficientProducts) > 0) {
            $errorMessage = 'Not enough stock for the following products: ' . implode(', ', $insufficientProducts);
            return redirect()->route('cart')->with('error', $errorMessage);
        }

        // Create a new order
        $order = new Order();
        $order->name = $validatedData['name'];
        $order->street = $validatedData['street'];
        $order->city = $validatedData['city'];
        $order->phone = $validatedData['phone'];
        $order->email = $validatedData['email'];
        $order->paymentMode = $validatedData['pay'];
        $order->totalPrice = $request->session()->get('cart_total_price', 0);
        $order->user_id = $userId;

        // Save the order
        $order->save();

        // Insert the sold products
        foreach ($cartItems as $item) {
            $product = Product::find($item->product_id);

            $soldProduct = new SoldProduct();
            $soldProduct->order_id = $order->id;
            $soldProduct->user_id = $userId;
            $soldProduct->product_id = $item->product_id;
            $soldProduct->quantity = $item->quantity;
            $soldProduct->price = $item->price;
            $soldProduct->totalPrice = $item->quantity * $item->price;
            $soldProduct->save();

            // Deduct the sold quantity from the product
            $product->quantity -= $item->quantity;
            $product->save();

            // Delete the cart item
            $item->delete();
        }

        // Update the cart total count and total price in the session
        $request->session()->forget('cart_total_count');
        $request->session()->forget('cart_total_price');

        // Redirect to a success page or display a success message
        return redirect()->route('cart')->with('success', 'Your order has been placed successfully!');
    }
}
