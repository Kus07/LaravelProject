<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('index')->with('products',$products);
    }

    // public function productDetails($id)
    // {
    //     $product = Product::find($id);
    //     $product = Product::take(5)->get();

    //     return view('product_details')
    //         ->with("product",$product)
    //         ->with("products",$products);
    // }
}
