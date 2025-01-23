<?php

namespace Database\Seeders;

use Carbon\Carbon; // Digunakan untuk mendapatkan waktu saat ini
use Illuminate\Database\Seeder; // Digunakan untuk mendefinisikan class seeder
use Illuminate\Support\Facades\DB; // Digunakan untuk mengakses query builder
use Illuminate\Support\Facades\Hash; // Digunakan untuk mengenkripsi password

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menyisipkan data pengguna ke dalam tabel 'users'
        DB::table('users')->insert([[
            'username' => 'owner', // Username pengguna
            'password' => Hash::make('123'), // Enkripsi password menggunakan Hash
            'created_at' => Carbon::now(), // Waktu pembuatan data
            'updated_at' => Carbon::now()  // Waktu pembaruan data
        ]]);
    }
}
