<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\IsLoggedin;
use Illuminate\Support\Facades\Route;

// Rute untuk halaman utama (home)
Route::get('/', [AppController::class, 'index'])->name('home');

// Rute untuk halaman "About"
Route::get('/about', [AppController::class, 'about'])->name('about');

// Rute untuk halaman login (menampilkan form login)
Route::get('/login', [AuthController::class, 'loginVIew'])->name('login');

// Rute untuk mengirimkan data login (proses autentikasi)
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Rute untuk logout pengguna
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute untuk CRUD kategori dengan middleware untuk memastikan pengguna sudah login
Route::resource('categories', CategoryController::class)->middleware(IsLoggedin::class);

// Rute untuk CRUD produk kecuali halaman "show" dengan middleware untuk memastikan pengguna sudah login
Route::resource('products', ProductController::class)->except(['show'])->middleware(IsLoggedin::class);

// Rute untuk halaman detail produk (mengakses metode show pada ProductController)
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
