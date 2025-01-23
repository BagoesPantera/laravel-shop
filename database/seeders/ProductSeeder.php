<?php

namespace Database\Seeders;

use App\Models\Product; // Hanya import Product yang digunakan
use Illuminate\Database\Seeder; // Import Seeder untuk mendefinisikan class seeder

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat 10 data produk menggunakan factory
        Product::factory()->count(10)->create();
    }
}
