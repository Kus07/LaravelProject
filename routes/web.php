<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserInsertController;

Route::get('/', [PagesController::class, 'login']);
Route::get('/login', [PagesController::class, 'login']);

Route::get('/login', [PagesController::class, 'login'])->name('login');
Route::post('/login', [PagesController::class, 'authenticate']);

Route::get('/register', [PagesController::class, 'register']);
Route::post('/create', [UserInsertController::class, 'insert']);
Route::get('/insert', [UserInsertController::class, 'insertform']);

Route::get('/contact', [PagesController::class, 'contact']);