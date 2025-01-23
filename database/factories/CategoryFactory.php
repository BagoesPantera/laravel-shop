<?php

namespace Database\Factories;

use App\Models\Category; // Mengimpor model Category
use Illuminate\Database\Eloquent\Factories\Factory; // Mengimpor class Factory untuk membuat factory

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Mengembalikan array yang berisi data default untuk model Category
        return [
            'name' => fake()->name(), // Menggunakan Faker untuk menghasilkan nama acak
            'created_at' => now(),    // Menetapkan waktu saat ini untuk created_at
            'updated_at' => now(),    // Menetapkan waktu saat ini untuk updated_at
        ];
    }
}
