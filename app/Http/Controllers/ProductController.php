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

    public function productDetails($id)
    {
        $product = Product::findOrFail($id);
        return view('Pages/productDetails', compact('product'));
    }

    public function editProducts()
    {
        return view('Pages/editProducts');
    }

    public function addedProducts()
    {
        return view('Pages/addProducts');
    }

    public function addProducts(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'productName' => 'required|string|max:255',
            'productDescription' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0.01',
            'category_id' => 'required|integer|exists:categories,id',
            'productImage' => 'required|image|max:2048',
        ]);

        // Save the product data
        $product = new Product();
        $product->user_id = $request->session()->get('user_id');
        $product->productName = $validatedData['productName'];
        $product->productDescription = $validatedData['productDescription'];
        $product->quantity = $validatedData['quantity'];
        $product->price = $validatedData['price'];
        $product->category_id = $validatedData['category_id'];

        // Handle the product image upload
        if ($request->hasFile('productImage')) {
            $imageName = time() . '.' . $request->file('productImage')->extension();
            $imagePath = $request->file('productImage')->move(public_path('product_images'), $imageName);
            $product->productImage = '/product_images/' . $imageName;
        }

        if ($product->save()) {
            // Clear the session data
            $request->session()->forget('product_data');
            return redirect()->route('addedProducts')->with('success', 'Product added successfully.');
        } else {
            // Store the user's input in the session
            $request->session()->put('product_data', $request->all());
            return redirect()->back()->with('error', 'Failed to add product.');
        }
    }
}
