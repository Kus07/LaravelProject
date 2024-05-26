<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        // Get the user ID from the session
        $userId = $request->session()->get('user_id');

        // Fetch the cart items for the current user
        $cartItems = Cart::where('user_id', $userId)
            ->get();

        // Lazy load the product information for each cart item
        $cartItems->load('product');

        // Pass the cart items to the view
        return view('Pages/cart', compact('cartItems'));
    }

    public function cartAdd(Request $request, Product $product)
    {
        // Get the user ID from the session
        $userId = $request->session()->get('user_id');

        // Check if the user is trying to add their own product to the cart
        if ($product->user_id == $userId) {
            return redirect()->back()->with('error', 'You cannot add your own product to the cart.');
        }

        // Create a new cart item
        $cartItem = new Cart();
        $cartItem->user_id = $userId;
        $cartItem->product_id = $product->id;
        $cartItem->price = $product->price;
        $cartItem->quantity = $request->input('quantity', 1); // Use the submitted quantity or default to 1
        $cartItem->save();

        // Redirect or return a response
        return redirect()->route('cart')->with('success', 'Product added to cart!');
    }
}
