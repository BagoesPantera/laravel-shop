<?php

namespace App\Http\Controllers;

use App\Models\Category; // Mengimpor model Category untuk operasi basis data kategori
use App\Models\Product; // Mengimpor model Product untuk operasi basis data produk
use App\Http\Requests\StoreProductRequest; // Mengimpor request untuk validasi saat menyimpan produk baru
use App\Http\Requests\UpdateProductRequest; // Mengimpor request untuk validasi saat memperbarui produk
use Carbon\Carbon; // Mengimpor Carbon untuk manipulasi waktu dan tanggal
use Illuminate\Contracts\View\Factory; // Mengimpor kontrak Factory untuk tipe data view
use Illuminate\Contracts\View\View; // Mengimpor kontrak View untuk tipe data view
use Illuminate\Foundation\Application; // Mengimpor Application untuk tipe data aplikasi
use Illuminate\Http\RedirectResponse; // Mengimpor RedirectResponse untuk tipe data pengembalian

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk.
     *
     * Method ini mengambil semua produk dengan relasi kategori dan mengirimkan data ke view 'product.index'.
     *
     * @return View|Factory|Application
     */
    public function index(): View|Factory|Application
    {
        // Mengambil semua produk beserta kategori terkait
        $products = Product::with('category')->get();

        // Mengembalikan view 'product.index' dengan data produk
        return view('product.index', compact('products'));
    }

    /**
     * Menampilkan form untuk membuat produk baru.
     *
     * Method ini mengembalikan view 'product.create' dengan daftar kategori yang ada.
     *
     * @return View|Factory|Application
     */
    public function create(): View|Factory|Application
    {
        // Mengambil semua kategori untuk digunakan di form pembuatan produk
        $categories = Category::all();

        // Mengembalikan view 'product.create' dengan data kategori
        return view('product.create', compact('categories'));
    }

    /**
     * Menyimpan produk baru ke dalam database.
     *
     * Method ini menerima input dari form pembuatan produk dan menyimpannya ke database.
     * Selain itu, produk juga menyertakan gambar yang diunggah.
     * Jika berhasil, pengguna diarahkan ke daftar produk. Jika gagal, pengguna diberi pesan error.
     *
     * @param StoreProductRequest $request
     * @return RedirectResponse
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        // Menyimpan gambar produk dengan nama unik menggunakan timestamp
        $imageName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $request->image->extension();
        $request->image->storeAs('images', $imageName);

        // Membuat objek produk baru dan mengisi dengan data dari form
        $product = new Product([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'description' => $request->description,
            'image' => '/images/' . $imageName, // Menyimpan path gambar
        ]);

        // Menyimpan produk ke database
        $save = $product->save();

        // Mengecek apakah penyimpanan berhasil
        if ($save) {
            return redirect()->route('products.index'); // Arahkan ke halaman daftar produk jika berhasil
        } else {
            // Kembalikan ke halaman sebelumnya dengan pesan error jika gagal
            return redirect()->back()->withErrors(['msg' => 'Gagal membuat produk, Coba lagi!']);
        }
    }

    /**
     * Menampilkan detail produk.
     *
     * Method ini mengembalikan data produk yang dipilih ke view 'product.show'.
     *
     * @param Product $product
     * @return View|Factory|Application
     */
    public function show(Product $product): View|Factory|Application
    {
        // Mengembalikan view 'product.show' dengan data produk yang dipilih
        return view('product.show', compact('product'));
    }

    /**
     * Menampilkan form untuk mengedit produk.
     *
     * Method ini mengembalikan form edit dengan data produk yang ada dan daftar kategori.
     *
     * @param Product $product
     * @return View|Factory|Application
     */
    public function edit(Product $product): View|Factory|Application
    {
        // Mengambil semua kategori untuk digunakan di form edit produk
        $categories = Category::all();

        // Mengembalikan view 'product.edit' dengan data produk dan kategori
        return view('product.edit', compact('product', 'categories'));
    }

    /**
     * Memperbarui produk yang ada di database.
     *
     * Method ini memperbarui data produk yang ada berdasarkan input dari form edit.
     * Jika ada gambar baru, gambar lama akan dihapus dan gambar baru akan disimpan.
     * Setelah pembaruan, pengguna diarahkan kembali ke daftar produk.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        // Mengambil nama gambar produk lama
        $imageName = explode('/', $product->image);
        $imageName = $imageName[count($imageName) - 1];

        // Mengecek jika ada gambar baru yang diunggah
        if ($request->has('image')) {
            // Membuat nama baru untuk gambar yang diunggah
            $imageName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->storeAs('images', $imageName);

            // Menghapus gambar lama jika ada
            if (file_exists(public_path('storage' . $product->image))) {
                unlink(public_path('storage' . $product->image));
            }
        }

        // Memperbarui data produk
        $update = $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'description' => $request->description,
            'image' => '/images/' . $imageName, // Menyimpan path gambar yang baru
        ]);

        // Mengecek apakah pembaruan berhasil
        if ($update) {
            return redirect()->route('products.index'); // Arahkan ke halaman daftar produk jika berhasil
        } else {
            // Kembalikan ke halaman sebelumnya dengan pesan error jika gagal
            return redirect()->back()->withErrors(['msg' => 'Gagal mengedit produk, Coba lagi!']);
        }
    }

    /**
     * Menghapus produk dari database.
     *
     * Method ini menghapus produk yang dipilih beserta gambarnya.
     * Setelah penghapusan, pengguna diarahkan ke daftar produk.
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        // Menghapus gambar produk dari penyimpanan
        if (file_exists(public_path('storage' . $product->image))) {
            unlink(public_path('storage' . $product->image));
        }

        // Menghapus produk dari database
        $delete = $product->delete();

        // Mengecek apakah penghapusan berhasil
        if ($delete) {
            return redirect()->route('products.index'); // Arahkan ke halaman daftar produk jika berhasil
        } else {
            // Kembalikan ke halaman sebelumnya dengan pesan error jika gagal
            return redirect()->back()->withErrors(['msg' => 'Gagal hapus produk, Coba lagi!']);
        }
    }
}
