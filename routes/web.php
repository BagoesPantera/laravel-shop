<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\IsLoggedin;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppController::class, 'index'])->name('home');
Route::get('/about', [AppController::class, 'about'])->name('about');

Route::get('/login', [AuthController::class, 'loginVIew'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('categories', CategoryController::class)->middleware(IsLoggedin::class);

Route::resource('products', ProductController::class)->except(['show'])->middleware(IsLoggedin::class);
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

