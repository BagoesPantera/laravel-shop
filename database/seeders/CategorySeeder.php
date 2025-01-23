<?php

namespace Database\Seeders;

use App\Models\Category; // Hanya import Category yang digunakan
use Illuminate\Database\Seeder; // Import Seeder untuk mendefinisikan class seeder

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat 10 data kategori menggunakan factory
        Category::factory()->count(10)->create();
    }
}
