<?php

namespace App\Models;

use Database\Factories\UserFactory; // Mengimpor UserFactory untuk pembuatan data dummy user (factory)
use Illuminate\Database\Eloquent\Factories\HasFactory; // Mengimpor HasFactory untuk penggunaan factory
use Illuminate\Foundation\Auth\User as Authenticatable; // Mengimpor User sebagai kelas dasar untuk otentikasi pengguna
use Illuminate\Notifications\Notifiable; // Mengimpor Notifiable untuk fitur notifikasi

class User extends Authenticatable
{
    /**
     * Menggunakan HasFactory untuk memungkinkan pembuatan data dummy user menggunakan factory.
     * @use HasFactory<UserFactory>
     */
    use HasFactory, Notifiable; // Menggunakan HasFactory untuk factory dan Notifiable untuk notifikasi

    /**
     * Atribut-atribut yang dapat diisi secara massal.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username', // Kolom username yang menyimpan nama pengguna
        'password', // Kolom password yang menyimpan kata sandi pengguna
    ];

    /**
     * Atribut-atribut yang harus disembunyikan saat serialisasi (misalnya, saat dikonversi ke JSON).
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',        // Menyembunyikan kolom password agar tidak disertakan dalam serialisasi
        'remember_token',  // Menyembunyikan kolom remember_token agar tidak disertakan dalam serialisasi
    ];

    /**
     * Menentukan tipe casting untuk atribut tertentu.
     *
     * Metode ini digunakan untuk mengonversi nilai atribut ke tipe data tertentu, seperti datetime atau hashed password.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // Mengonversi nilai email_verified_at menjadi objek datetime
            'password' => 'hashed', // Menyimpan password dalam format hashed
        ];
    }
}
