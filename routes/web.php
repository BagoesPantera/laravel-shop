<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppController::class, 'index']);

Route::resource('categories', CategoryController::class);

Route::resource('products', ProductController::class);
