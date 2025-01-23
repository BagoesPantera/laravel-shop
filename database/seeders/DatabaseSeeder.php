<?php

namespace Database\Seeders;

use App\Models\User; // Mengimpor model User
use Illuminate\Database\Seeder; // Mengimpor Seeder untuk mendefinisikan class seeder

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Fungsi ini akan menjalankan semua seeder yang diperlukan untuk mengisi database
     * dengan data awal.
     */
    public function run(): void
    {
        // Menjalankan beberapa seeder untuk mengisi database
        $this->call([
            UserSeeder::class, // Menjalankan seeder untuk tabel 'users'
            CategorySeeder::class, // Menjalankan seeder untuk tabel 'categories'
            ProductSeeder::class, // Menjalankan seeder untuk tabel 'products'
        ]);
    }
}
