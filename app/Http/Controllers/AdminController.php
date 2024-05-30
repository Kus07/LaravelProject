<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'pending')->paginate(20);
        return view('Pages/adminPage', compact('products'));
    }

    public function approveProduct($id)
    {
        $product = Product::findOrFail($id);
        try {
            $product->status = 'approved';
            $product->save();

            return redirect()->back()->with('success', 'Product approved successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while approving the product.');
        }
    }

    public function denyProduct($id)
    {
        $product = Product::findOrFail($id);
        try {
            $product->status = 'denied';
            $product->save();

            return redirect()->back()->with('success', 'Product removed successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while removing the product.');
        }
    }
}
