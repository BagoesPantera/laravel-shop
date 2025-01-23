<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule; // Mengimpor ValidationRule untuk tipe data aturan validasi
use Illuminate\Foundation\Http\FormRequest; // Mengimpor FormRequest sebagai kelas dasar untuk request dengan validasi

class LoginRequest extends FormRequest
{
    /**
     * Menentukan apakah pengguna diizinkan untuk melakukan request ini.
     *
     * Dalam kasus ini, pengguna diizinkan untuk membuat request login.
     * Anda dapat menambahkan logika lain untuk memeriksa hak akses pengguna jika diperlukan.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Mengizinkan semua pengguna untuk mengakses form login
    }

    /**
     * Mendapatkan aturan validasi yang berlaku untuk request ini.
     *
     * Pada form login, kita memvalidasi dua input yaitu username dan password.
     * Kedua input tersebut diwajibkan untuk diisi.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required', // Menandakan bahwa field 'username' wajib diisi
            'password' => 'required', // Menandakan bahwa field 'password' wajib diisi
        ];
    }
}
