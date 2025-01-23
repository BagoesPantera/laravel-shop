<?php

namespace App\Http\Controllers;

use App\Models\Category; // Mengimpor model Category untuk operasi basis data kategori
use App\Http\Requests\StoreCategoryRequest; // Mengimpor request untuk validasi data saat menyimpan kategori baru
use App\Http\Requests\UpdateCategoryRequest; // Mengimpor request untuk validasi data saat memperbarui kategori
use Illuminate\Http\RedirectResponse; // Mengimpor RedirectResponse untuk tipe data pengembalian
use Illuminate\View\View; // Mengimpor View untuk tipe data pengembalian

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar semua kategori.
     *
     * Method ini mengambil semua kategori dari database dan mengirimkannya ke view 'category.index'.
     *
     * @return View
     */
    public function index(): View
    {
        // Mengambil semua kategori dari tabel 'categories'
        $categories = Category::all();

        // Mengembalikan view 'category.index' dengan data kategori
        return view('category.index', compact('categories'));
    }

    /**
     * Menampilkan form untuk membuat kategori baru.
     *
     * Method ini mengembalikan view 'category.create' yang berisi form untuk input kategori baru.
     *
     * @return View
     */
    public function create(): View
    {
        // Mengembalikan view form pembuatan kategori
        return view('category.create');
    }

    /**
     * Menyimpan kategori yang baru dibuat ke dalam database.
     *
     * Method ini menerima input dari form pembuatan kategori, membuat objek kategori baru,
     * dan menyimpannya ke dalam database.
     * Jika berhasil, pengguna diarahkan ke daftar kategori. Jika gagal, pengguna diberi pesan error.
     *
     * @param StoreCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        // Membuat objek kategori baru dan mengisi dengan data dari request
        $category = new Category([
            'name' => $request->name, // Menyimpan nama kategori yang dikirimkan dari form
        ]);

        // Menyimpan kategori ke database
        $save = $category->save();

        // Mengecek apakah penyimpanan berhasil
        if ($save) {
            return redirect()->route('categories.index'); // Jika berhasil, arahkan ke halaman daftar kategori
        } else {
            // Jika gagal, kembalikan dengan pesan error
            return redirect()->back()->withErrors(['msg' => 'Gagal membuat kategori, Coba lagi!']);
        }
    }

    /**
     * Method ini tetap diisi karena digunakan dalam testing
     *
     * @param Category $category
     * @return void
     */
    public function show(Category $category): void
    {
        // Tetap diisikan untuk testing.
    }

    /**
     * Menampilkan form untuk mengedit kategori tertentu.
     *
     * Method ini mengembalikan form edit untuk kategori yang dipilih.
     *
     * @param Category $category
     * @return View
     */
    public function edit(Category $category): View
    {
        // Mengembalikan view 'category.edit' dengan data kategori yang akan diedit
        return view('category.edit', compact('category'));
    }

    /**
     * Memperbarui data kategori yang ada di database.
     *
     * Method ini menerima input dari form edit kategori, memperbarui data kategori yang ada,
     * dan menyimpannya ke dalam database.
     * Jika berhasil, pengguna diarahkan ke daftar kategori. Jika gagal, pengguna diberi pesan error.
     *
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        // Memperbarui kategori dengan data dari request
        $update = $category->update([
            'name' => $request->get('name'), // Memperbarui nama kategori
        ]);

        // Mengecek apakah pembaruan berhasil
        if ($update) {
            return redirect()->route('categories.index'); // Jika berhasil, arahkan ke halaman daftar kategori
        } else {
            // Jika gagal, kembalikan dengan pesan error
            return redirect()->back()->withErrors(['msg' => 'Gagal mengedit kategori, Coba lagi!']);
        }
    }

    /**
     * Menghapus kategori dari database.
     *
     * Method ini menghapus kategori yang dipilih dari database.
     * Jika berhasil, pengguna diarahkan ke daftar kategori. Jika gagal, pengguna diberi pesan error.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        // Menghapus kategori dari database
        $delete = $category->delete();

        // Mengecek apakah penghapusan berhasil
        if ($delete) {
            return redirect()->route('categories.index'); // Jika berhasil, arahkan ke halaman daftar kategori
        } else {
            // Jika gagal, kembalikan dengan pesan error
            return redirect()->back()->withErrors(['msg' => 'Gagal hapus kategori, Coba lagi!']);
        }
    }
}
