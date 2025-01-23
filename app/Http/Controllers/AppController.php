<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

// Mengimpor model Product untuk digunakan dalam controller

class AppController extends Controller
{
    /**
     * Menampilkan daftar semua produk.
     *
     * Method ini mengambil semua data produk dari database dan mengirimkannya ke view 'index'.
     *
     * @return View
     */
    public function index(): View
    {
        // Mengambil semua data produk dari tabel 'products'
        $products = Product::all();

        // Mengembalikan view 'index' dengan data produk yang sudah diambil
        return view('index', compact('products'));
    }

    /**
     * Menampilkan halaman tentang.
     *
     * Method ini hanya mengembalikan view 'about' tanpa data tambahan.
     *
     * @return View
     */
    public function about(): View
    {
        // Mengembalikan view 'about' yang berisi informasi tentang aplikasi
        return view('about');
    }
}
