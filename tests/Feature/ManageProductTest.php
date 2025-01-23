<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ManageProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_can_create_product()
    {
        // Membuat pengguna baru dengan username
        $user = User::factory()->create();

        // Login sebagai pengguna
        $this->actingAs($user);

        // Membuat kategori untuk produk
        $category = Category::factory()->create();

        // Simulasi file gambar sementara
        $image = UploadedFile::fake()->image('product.jpg', 600, 600);

        // Data produk yang akan dikirimkan
        $productData = [
            'category_id' => $category->id,
            'name' => 'Test Product',
            'description' => 'This is a test product.',
            'qty' => 100,
            'price' => 50000,
            'image' => $image, // Lampirkan file gambar menggunakan key 'image'
        ];

        // Menyimpan file di disk 'public/images', pastikan nama file sesuai
        $imageName = $image->hashName();
        $image->storeAs('images', $imageName, 'public');

        // Kirim request untuk membuat produk baru dengan gambar
        $response = $this->post('/products', $productData);

        // Verifikasi apakah kita diarahkan setelah membuat produk
        $response->assertRedirect('/products');

        $createdProduct = Product::first();

        // Pastikan file gambar telah disimpan di storage/public/images dengan nama yang benar
        Storage::disk('public')->assertExists($createdProduct->image);

        // Pastikan data produk ada di database dengan nama file gambar yang benar
        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'description' => 'This is a test product.',
            'qty' => 100,
            'price' => 50000,
            'image' => $createdProduct->image, // Path file gambar yang benar
        ]);
    }

    public function test_can_read_product()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);
        $response = $this->get('/products/' . $product->id);
        $response->assertStatus(200);
    }

    public function test_can_update_product()
    {
        // Fake storage agar tidak menyentuh disk nyata
//        Storage::fake('public');
        // Membuat pengguna baru dengan username
        $user = User::factory()->create();

        // Login sebagai pengguna
        $this->actingAs($user);

        // Buat kategori dan produk yang akan di-update
        $category = Category::factory()->create();
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'name' => 'Old Product Name',
            'description' => 'Old description',
            'qty' => 50,
            'price' => 30000,
            'image' => '/images/oldimage.jpg', // Nama file gambar sebelumnya
        ]);

        // Simulasi gambar baru yang di-upload
        $newImage = UploadedFile::fake()->image('newproduct.jpg', 600, 600);

        // Data untuk memperbarui produk
        $updatedData = [
            'category_id' => $category->id,
            'name' => 'Updated Product Name',
            'description' => 'Updated product description',
            'qty' => 60,
            'price' => 35000,
            'image' => $newImage, // Gambar baru
        ];

        // Kirim request untuk mengupdate produk
        $response = $this->put("/products/{$product->id}", $updatedData);

        // Verifikasi apakah kita diarahkan setelah update
        $response->assertRedirect('/products');

        $newUpdatedProduct = Product::first();

        // Pastikan gambar baru telah disimpan di storage/public/images
        Storage::disk('public')->assertExists($newUpdatedProduct->image);

        // Pastikan data produk di database telah diperbarui dengan path gambar yang baru
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Product Name',
            'description' => 'Updated product description',
            'qty' => 60,
            'price' => 35000,
            'image' => $newUpdatedProduct->image, // Path gambar yang baru
        ]);
    }

    public function test_can_delete_product()
    {
        // Membuat pengguna baru dengan username
        $user = User::factory()->create();

        // Login sebagai pengguna
        $this->actingAs($user);

        // Membuat kategori untuk produk
        $category = Category::factory()->create();

        $image = UploadedFile::fake()->image('oldimage.jpg', 600, 600);

        // Menyimpan file di disk 'public/images', pastikan nama file sesuai
        $imageName = $image->hashName();
        $image->storeAs('images', $imageName);

        // Membuat produk baru untuk dihapus
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'name' => 'Test Product to Delete',
            'description' => 'This product will be deleted.',
            'qty' => 100,
            'price' => 50000,
            'image' => '/images/' . $imageName, // Simulasikan file gambar
        ]);

        // Simulasi file gambar sementara


        // Pastikan gambar ada sebelum dihapus
        Storage::disk('public')->assertExists($product->image);

        // Kirim request untuk menghapus produk
        $response = $this->delete("/products/{$product->id}");

        // Verifikasi apakah kita diarahkan setelah penghapusan
        $response->assertRedirect('/products');

        // Pastikan produk telah dihapus dari database
        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);

        // Pastikan gambar terkait produk juga telah dihapus
        Storage::disk('public')->assertMissing($product->image);
    }
}
