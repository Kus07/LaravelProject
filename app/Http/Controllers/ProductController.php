<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $products = Product::paginate(8);
        return view('Pages/products', compact('products'));
    }

    public function category($categoryId)
    {
        $products = Product::where('category_id', $categoryId)->paginate(8);
        $category = Category::find($categoryId);
        return view('Pages/categories', compact('products', 'category'));

    }

    public function myProducts()
    {
        $userId = session('user_id');
        $products = Product::where('user_id', $userId)->paginate(8);
        return view('Pages/myProducts', compact('products'));
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
