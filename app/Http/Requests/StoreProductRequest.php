<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule; // Mengimpor ValidationRule untuk aturan validasi
use Illuminate\Foundation\Http\FormRequest; // Mengimpor FormRequest sebagai kelas dasar untuk request dengan validasi

class StoreProductRequest extends FormRequest
{
    /**
     * Menentukan apakah pengguna diizinkan untuk membuat request ini.
     *
     * Pada metode ini, kami memeriksa apakah pengguna sudah terautentikasi menggunakan auth()->check().
     * Request ini hanya diizinkan untuk pengguna yang sudah login.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check(); // Memastikan hanya pengguna yang sudah login yang dapat mengakses request ini
    }

    /**
     * Mendapatkan aturan validasi yang berlaku untuk request ini.
     *
     * Untuk membuat produk baru, kita memvalidasi beberapa field seperti 'category_id', 'name', 'description',
     * 'qty', 'price', dan 'image'. Semua field tersebut wajib diisi dan terdapat beberapa aturan tambahan
     * untuk memastikan data yang diterima valid.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id', // 'category_id' wajib diisi dan harus ada di tabel 'categories'
            'name' => 'required', // 'name' wajib diisi
            'description' => 'required', // 'description' wajib diisi
            'qty' => 'required', // 'qty' wajib diisi
            'price' => 'required', // 'price' wajib diisi
            'image' => 'required', // 'image' wajib diisi
        ];
    }
}
