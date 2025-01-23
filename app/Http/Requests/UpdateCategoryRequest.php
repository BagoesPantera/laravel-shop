<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule; // Mengimpor ValidationRule untuk aturan validasi
use Illuminate\Foundation\Http\FormRequest; // Mengimpor FormRequest sebagai kelas dasar untuk request dengan validasi

class UpdateCategoryRequest extends FormRequest
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
     * Untuk memperbarui kategori yang ada, kita hanya memvalidasi field 'name'.
     * Field 'name' wajib diisi saat pengguna mengirimkan request untuk mengupdate kategori.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required', // 'name' wajib diisi untuk memperbarui kategori
        ];
    }
}
