<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('user_email')) {
            $userEmail = $request->session()->get('user_email');
            $products = Product::paginate(8);
            return view('Pages/products', compact('userEmail', 'products'));
        } else {
            return redirect()->route('login')->with('error', 'Please log in to access the products page.');
        }
    }

    public function category(Request $request, $categoryId)
    {
        if ($request->session()->has('user_email')) {
            $userEmail = $request->session()->get('user_email');
            $products = Product::where('category_id', $categoryId)->paginate(8);
            $category = Category::find($categoryId);
            return view('Pages/categories', compact('userEmail', 'products', 'category'));
        } else {
            return redirect()->route('login')->with('error', 'Please log in to access the category page.');
        }
    }

    public function myProducts(Request $request)
    {
        if ($request->session()->has('user_email')) {
            $userId = $request->session()->get('user_id');
            $products = Product::where('user_id', $userId)->paginate(8);
            return view('Pages/myProducts', compact('products'));
        } else {
            return redirect()->route('login')->with('error', 'Please log in to access your products.');
        }
    }

    public function productDetails(Request $request, $id)
    {
        if ($request->session()->has('user_email')) {
            $userEmail = $request->session()->get('user_email');
            $product = Product::findOrFail($id);
            return view('Pages/productDetails', compact('userEmail', 'product'));
        } else {
            return redirect()->route('login')->with('error', 'Please log in to view the product details.');
        }
    }

    public function editProducts(Request $request)
    {
        if ($request->session()->has('user_email')) {
            $userEmail = $request->session()->get('user_email');
            return view('Pages/editProducts', compact('userEmail'));
        } else {
            return redirect()->route('login')->with('error', 'Please log in to edit your products.');
        }
    }

    public function addedProducts(Request $request)
    {
        if ($request->session()->has('user_email')) {
            $userEmail = $request->session()->get('user_email');
            return view('Pages/addProducts', compact('userEmail'));
        } else {
            return redirect()->route('login')->with('error', 'Please log in to add new products.');
        }
    }

    public function addProducts(Request $request)
    {
        if ($request->session()->has('user_email')) {
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
        } else {
            return redirect()->route('login')->with('error', 'Please log in to add new products.');
        }
    }
}
