<?php

namespace Database\Factories;

use App\Models\Product; // Mengimpor model Product untuk membuat factory terkait model ini
use Illuminate\Database\Eloquent\Factories\Factory; // Mengimpor class Factory untuk membuat instance factory
use Illuminate\Http\UploadedFile; // Mengimpor class UploadedFile untuk memalsukan file gambar

/**
 * Factory untuk menghasilkan data palsu (dummy) untuk model Product.
 *
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Menentukan keadaan default model Product.
     *
     * Fungsi ini digunakan untuk mendefinisikan data palsu yang akan digunakan
     * untuk membuat instance model Product ketika menjalankan factory.
     *
     * @return array<string, mixed> Data default untuk model Product.
     */
    public function definition(): array
    {
        // Membuat file gambar palsu menggunakan UploadedFile
        $image = UploadedFile::fake()->image('oldimage.jpg', 600, 600); // Membuat gambar palsu dengan ukuran 600x600

        // Menyimpan gambar palsu di disk 'public/images', memastikan nama file sesuai
        $imageName = $image->hashName(); // Mendapatkan nama file yang telah di-hash
        $image->storeAs('images', $imageName); // Menyimpan gambar ke direktori 'images' di storage

        return [
            'category_id' => $this->faker->numberBetween(1, 10), // ID kategori acak antara 1 dan 10
            'name' => $this->faker->name(), // Nama produk acak
            'description' => $this->faker->text(), // Deskripsi produk acak
            'price' => $this->faker->randomFloat(2, 10), // Harga produk acak dengan dua digit desimal
            'qty' => $this->faker->numberBetween(1, 10), // Jumlah produk acak antara 1 dan 10
            'image' => '/images/' . $imageName, // Path gambar yang telah disimpan
        ];
    }
}
