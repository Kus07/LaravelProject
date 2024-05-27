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
        // Check if the user is authenticated
        if (!$request->session()->has('user_id')) {
            return redirect()->route('login')->with('error', 'Please log in to place an order.');
        }

        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required',
            'street' => 'required',
            'city' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'pay' => 'required|in:paypal,mastercard,visa,american express,discover',
        ]);

        $userId = $request->session()->get('user_id');

        $cartItems = Cart::where('user_id', $userId)->get();

        $insufficientProducts = [];
        foreach ($cartItems as $item) {
            $product = Product::find($item->product_id);
            if ($item->quantity > $product->quantity) {
                $insufficientProducts[] = $product->productName;
            }
        }

        if (count($insufficientProducts) > 0) {
            $errorMessage = 'Not enough stock for the following products: ' . implode(', ', $insufficientProducts);
            return redirect()->route('cart')->with('error', $errorMessage);
        }

        $order = new Order();
        $order->name = $validatedData['name'];
        $order->street = $validatedData['street'];
        $order->city = $validatedData['city'];
        $order->phone = $validatedData['phone'];
        $order->email = $validatedData['email'];
        $order->paymentMode = $validatedData['pay'];
        $order->totalPrice = $request->session()->get('cart_total_price', 0);
        $order->user_id = $userId;
        $order->save();

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

            $product->quantity -= $item->quantity;
            $product->save();

            $item->delete();
        }

        $request->session()->forget('cart_total_count');
        $request->session()->forget('cart_total_price');

        return redirect()->route('cart')->with('success', 'Your order has been placed successfully!');
    }
}
