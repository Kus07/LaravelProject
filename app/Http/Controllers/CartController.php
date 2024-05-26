<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index(Request $request)
    {
        $userId = $request->session()->get('user_id');

        $cartItems = Cart::where('user_id', $userId)
            ->with('product:id,productName,price,productImage')
            ->get();

        return view('Pages/cart', compact('cartItems'));
    }

    public function cartAdd(Request $request, Product $product)
    {
        $userId = $request->session()->get('user_id');

        if ($product->user_id == $userId) {
            return redirect()->back()->with('error', 'You cannot add your own product to the cart.');
        }

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
