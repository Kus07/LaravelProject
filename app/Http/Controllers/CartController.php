<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index(Request $request)
    {
        if ($request->session()->has('user_email')) {
            $userId = $request->session()->get('user_id');

            $cartItems = Cart::where('user_id', $userId)
                ->with('product:id,productName,price,productImage')
                ->get();

            return view('Pages/cart', compact('cartItems'));
        } else {
            return redirect()->route('login')->with('error', 'Please log in to access your cart.');
        }
    }

    public function cartAdd(Request $request, Product $product)
    {
        if ($request->session()->has('user_email')) {
            $userId = $request->session()->get('user_id');

            if ($product->user_id == $userId) {
                return redirect()->back()->with('error', 'You cannot add your own product to the cart.');
            }

            $requestedQuantity = $request->input('quantity', 1);

            if ($requestedQuantity > $product->quantity) {
                return redirect()->back()->with('error', 'The requested quantity is not available.');
            }

            $cartItem = new Cart();
            $cartItem->user_id = $userId;
            $cartItem->product_id = $product->id;
            $cartItem->price = $product->price;
            $cartItem->quantity = $requestedQuantity;
            $cartItem->save();

            $cartItems = Cart::where('user_id', $userId)->get();
            $totalCount = 0;
            $totalPrice = 0;

            foreach ($cartItems as $item) {
                $totalCount += $item->quantity;
                $totalPrice += $item->quantity * $item->price;
            }

            $request->session()->put('cart_total_count', $totalCount);
            $request->session()->put('cart_total_price', $totalPrice);

            return redirect()->route('cart')->with('success', 'Product added to cart!');
        } else {
            return redirect()->route('login')->with('error', 'Please log in to add products to the cart.');
        }
    }

    public function cartRemove(Request $request, Cart $cartItem)
    {
        if ($request->session()->has('user_email')) {
            $userId = $request->session()->get('user_id');

            if ($cartItem->user_id !== $userId) {
                return redirect()->route('cart')->with('error', 'You are not authorized to remove this item from the cart.');
            }

            $cartItem->delete();

            $cartItems = Cart::where('user_id', $userId)->get();
            $totalCount = 0;
            $totalPrice = 0;

            foreach ($cartItems as $item) {
                $totalCount += $item->quantity;
                $totalPrice += $item->quantity * $item->price;
            }

            $request->session()->put('cart_total_count', $totalCount);
            $request->session()->put('cart_total_price', $totalPrice);

            return redirect()->route('cart')->with('success', 'Item removed from the cart successfully.');
        } else {
            return redirect()->route('login')->with('error', 'Please log in to remove items from the cart.');
        }
    }
}
