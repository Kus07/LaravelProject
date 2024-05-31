<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserInsertController;

Route::get('/', [PagesController::class, 'login'])->name('login');
Route::get('/login', [PagesController::class, 'login'])->name('login');
Route::post('/authenticate', [PagesController::class, 'authenticate'])->name('authenticate');

// Registration routes
Route::get('/register', [PagesController::class, 'register'])->name('register');
Route::post('/register', [UserInsertController::class, 'insert'])->name('register');

// Contact route
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/editProfile', [ProfileController::class, 'editProfile'])->name('editProfile');

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::get('/product/{id}', [ProductController::class, 'productDetails'])->name('productDetails');

Route::match(['get', 'post'], '/cartAdd/{product}', [CartController::class, 'cartAdd'])->name('cartAdd');


Route::get('/category/{id}', [ProductController::class, 'category'])->name('category');

Route::get('/myProducts', [ProductController::class, 'myProducts'])->name('myProducts');


Route::get('/cart', [CartController::class, 'index'])->name('cart');

Route::post('/addProducts', [ProductController::class, 'addProducts'])->name('addProducts');

Route::get('/addedProducts', [ProductController::class, 'addedProducts'])->name('addedProducts');

Route::post('/cartRemove/{cartItem}', [CartController::class, 'cartRemove'])->name('cartRemove');

Route::get('/products/{id}/edit', [ProductController::class, 'editProducts'])->name('editProducts');
Route::post('/products/{id}', [ProductController::class, 'updateProducts'])->name('updateProducts');

Route::post('/addOrder', [OrderController::class, 'addOrder'])->name('addOrder');

Route::get('/search', [ProductController::class, 'search'])->name('search');

Route::get('/adminPage', [AdminController::class, 'index'])->name('adminPage');

Route::get('/approveProduct/{id}', [AdminController::class, 'approveProduct'])->name('approveProduct');

Route::get('/denyProduct/{id}', [AdminController::class, 'denyProduct'])->name('denyProduct');

Route::post('/send-order-confirmation', [OrderController::class, 'sendOrderConfirmation']);
