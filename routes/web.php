<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\IsLoggedin;
use Illuminate\Support\Facades\Route;

// Rute untuk halaman utama (home)
// Menampilkan halaman utama dengan memanggil method 'index' dari AppController
Route::get('/', [AppController::class, 'index'])->name('home');

// Rute untuk halaman "About"
// Menampilkan halaman "About" dengan memanggil method 'about' dari AppController
Route::get('/about', [AppController::class, 'about'])->name('about');

// Rute untuk halaman login (menampilkan form login)
// Menggunakan middleware 'guest' untuk memastikan hanya pengguna yang belum login yang dapat mengaksesnya
Route::get('/login', [AuthController::class, 'loginVIew'])->name('login')->middleware('guest');

// Rute untuk mengirimkan data login (proses autentikasi)
// Menggunakan middleware 'guest' untuk memastikan hanya pengguna yang belum login yang dapat mengaksesnya
Route::post('/login', [AuthController::class, 'login'])->name('login.post')->middleware('guest');

// Rute untuk logout pengguna
// Menggunakan middleware 'isLoggedin' untuk memastikan hanya pengguna yang sudah login yang dapat logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware(IsLoggedin::class);

// Rute untuk CRUD kategori dengan middleware untuk memastikan pengguna sudah login
// Menggunakan resource controller untuk operasi CRUD pada kategori
Route::resource('categories', CategoryController::class)->middleware(IsLoggedin::class);

// Rute untuk CRUD produk kecuali halaman "show" dengan middleware untuk memastikan pengguna sudah login
// Menggunakan resource controller untuk operasi CRUD pada produk (tanpa 'show' method)
Route::resource('products', ProductController::class)->except(['show'])->middleware(IsLoggedin::class);

// Rute untuk halaman detail produk (mengakses metode show pada ProductController)
// Menampilkan halaman detail produk berdasarkan ID produk yang dipilih
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
