<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\LogoutController;
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
