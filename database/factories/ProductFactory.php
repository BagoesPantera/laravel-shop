<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $image = UploadedFile::fake()->image('oldimage.jpg', 600, 600);

        // Menyimpan file di disk 'public/images', pastikan nama file sesuai
        $imageName = $image->hashName();
        $image->storeAs('images', $imageName);

        return [
            'category_id' => $this->faker->numberBetween(1, 10),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomFloat(2, 10),
            'qty' => $this->faker->numberBetween(1, 10),
            'image' =>'/images/' . $imageName,
        ];
    }
}
