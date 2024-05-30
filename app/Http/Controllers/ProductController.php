<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('user_email')) {
            $userEmail = $request->session()->get('user_email');
            $products = Product::where('quantity', '>', 0)
                              ->where('status', 'approved')
                              ->paginate(8);
            return view('Pages/products', compact('userEmail', 'products'));
        } else {
            return redirect()->route('login')->with('error', 'Please log in to access the products page.');
        }
    }

    public function category(Request $request, $categoryId)
    {
        if ($request->session()->has('user_email')) {
            $userEmail = $request->session()->get('user_email');
            $products = Product::where('category_id', $categoryId)
                          ->where('quantity', '>', 0)
                          ->where('status', 'approved')
                          ->paginate(8);
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
            $validatedData = $request->validate([
                'productName' => 'required|string|max:255',
                'productDescription' => 'required|string',
                'quantity' => 'required|integer|min:1',
                'price' => 'required|numeric|min:0.01',
                'category_id' => 'required|integer|exists:categories,id',
                'productImage' => 'required|image|max:2048',
            ]);

            $product = new Product();
            $product->user_id = $request->session()->get('user_id');
            $product->productName = $validatedData['productName'];
            $product->productDescription = $validatedData['productDescription'];
            $product->quantity = $validatedData['quantity'];
            $product->price = $validatedData['price'];
            $product->category_id = $validatedData['category_id'];
            $product->status = 'pending';

            if ($request->hasFile('productImage')) {
                $imageName = time() . '.' . $request->file('productImage')->extension();
                $imagePath = $request->file('productImage')->move(public_path('product_images'), $imageName);
                $product->productImage = '/product_images/' . $imageName;
            }

            if ($product->save()) {
                $request->session()->forget('product_data');
                return redirect()->route('addedProducts')->with('success', 'Product added successfully.');
            } else {
                $request->session()->put('product_data', $request->all());
                return redirect()->back()->with('error', 'Failed to add product.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Please log in to add new products.');
        }
    }

    public function search(Request $request)
    {
        if ($request->session()->has('user_email')) {
            $userEmail = $request->session()->get('user_email');

            $search = $request->input('search');
            $perPage = $request->input('page', 8);

            $products = Product::where('quantity', '>', 0)
                             ->where('productName', 'like', '%' . $search . '%')
                             ->paginate($perPage);

            return view('Pages/products', compact('userEmail', 'products', 'search', 'perPage'));
        } else {
            return redirect()->route('login')->with('error', 'Please log in to access the products page.');
        }
    }

    public function editProducts(Request $request, $id)
    {
        if ($request->session()->has('user_id')) {
            $userId = $request->session()->get('user_id');
            $products = Product::where('user_id', $userId)->get();

            $product = Product::findOrFail($id);

            if ($product->user_id === $userId) {
                if ($request->isMethod('post')) {
                    $product->productName = $request->input('productName');
                    $product->productDescription = $request->input('productDescription');
                    $product->price = $request->input('price');
                    $product->category_id = $request->input('category_id');
                    $product->quantity = $request->input('quantity');

                    if ($request->hasFile('productImage')) {
                        $image = $request->file('productImage');
                        $imageName = time() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('images'), $imageName);
                        $product->productImage = $imageName;
                    }

                    $product->save();

                    return redirect()->back()->with('success', 'Product updated successfully.');
                } else {
                    return view('Pages/editProducts', [
                        'products' => $products,
                        'userId' => $userId,
                        'product' => $product,
                    ]);
                }
            } else {
                return redirect()->back()->with('error', 'You are not authorized to edit this product.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Please log in to edit your products.');
        }
    }

    public function updateProducts(Request $request, $id)
    {
        if ($request->session()->has('user_email')) {
            $userEmail = $request->session()->get('user_email');

            $validatedData = $request->validate([
                'name' => 'required',
                'description' => 'required',
                'quantity' => 'nullable',
                'price' => 'required|numeric',
                'productImage' => 'nullable|image|max:2048',
            ]);

            $product = Product::findOrFail($id);

            $product->productName = $validatedData['name'];
            $product->productDescription = $validatedData['description'];
            $product->quantity = $validatedData['quantity'];
            $product->price = $validatedData['price'];
            $product->status = 'pending';

            if ($request->hasFile('productImage')) {
                if ($product->productImage) {
                    Storage::delete($product->productImage);
                }

                $imagePath = $request->file('productImage')->store('product_images', 'public');
                $product->productImage = $imagePath;
            }

            $product->save();

            return redirect()->route('editProducts', $product->id)->with('success', 'Product updated successfully.');        } else {
            return redirect()->route('login')->with('error', 'Please log in to update products.');
        }
    }

}
