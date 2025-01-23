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
    use RefreshDatabase; // Menggunakan trait RefreshDatabase untuk reset database setelah setiap test.

    /**
     * Menguji fitur untuk membuat produk baru.
     */
    public function test_can_create_product()
    {
        // Membuat pengguna baru dengan username
        $user = User::factory()->create();

        // Login sebagai pengguna yang baru dibuat
        $this->actingAs($user);

        // Membuat kategori untuk produk yang akan dibuat
        $category = Category::factory()->create();

        // Simulasi file gambar yang di-upload dengan ukuran 600x600px
        $image = UploadedFile::fake()->image('product.jpg', 600, 600);

        // Data produk yang akan dikirimkan dalam request
        $productData = [
            'category_id' => $category->id,
            'name' => 'Test Product',
            'description' => 'This is a test product.',
            'qty' => 100,
            'price' => 50000,
            'image' => $image, // File gambar yang di-upload
        ];

        // Menyimpan gambar di disk 'public/images'
        $imageName = $image->hashName();
        $image->storeAs('images', $imageName, 'public');

        // Kirim request untuk membuat produk baru
        $response = $this->post('/products', $productData);

        // Verifikasi apakah pengguna diarahkan ke halaman produk setelah produk dibuat
        $response->assertRedirect('/products');

        // Ambil produk pertama yang baru dibuat
        $createdProduct = Product::first();

        // Pastikan gambar telah disimpan di storage
        Storage::disk('public')->assertExists($createdProduct->image);

        // Pastikan data produk ada di database dengan nama gambar yang benar
        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'description' => 'This is a test product.',
            'qty' => 100,
            'price' => 50000,
            'image' => $createdProduct->image, // Path file gambar yang benar
        ]);
    }

    /**
     * Menguji fitur untuk membaca (menampilkan) detail produk.
     */
    public function test_can_read_product()
    {
        // Membuat pengguna dan login
        $user = User::factory()->create();
        $this->actingAs($user);

        // Membuat kategori dan produk yang akan dibaca
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        // Kirim request untuk melihat detail produk
        $response = $this->get('/products/' . $product->id);

        // Verifikasi bahwa request berhasil dan statusnya adalah 200 OK
        $response->assertStatus(200);
    }

    /**
     * Menguji fitur untuk memperbarui produk yang sudah ada.
     */
    public function test_can_update_product()
    {
        // Menggunakan fake storage agar tidak menyentuh disk nyata
        // Storage::fake('public');

        // Membuat pengguna dan login
        $user = User::factory()->create();
        $this->actingAs($user);

        // Membuat kategori dan produk yang akan di-update
        $category = Category::factory()->create();
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'name' => 'Old Product Name',
            'description' => 'Old description',
            'qty' => 50,
            'price' => 30000,
            'image' => '/images/oldimage.jpg', // Gambar lama
        ]);

        // Simulasi gambar baru yang di-upload
        $newImage = UploadedFile::fake()->image('newproduct.jpg', 600, 600);

        // Data produk yang akan digunakan untuk update
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

        // Verifikasi apakah kita diarahkan setelah update produk
        $response->assertRedirect('/products');

        // Ambil produk yang baru saja diupdate
        $newUpdatedProduct = Product::first();

        // Pastikan gambar baru telah disimpan
        Storage::disk('public')->assertExists($newUpdatedProduct->image);

        // Pastikan data produk di database telah diperbarui dengan gambar yang baru
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Product Name',
            'description' => 'Updated product description',
            'qty' => 60,
            'price' => 35000,
            'image' => $newUpdatedProduct->image, // Path gambar yang baru
        ]);
    }

    /**
     * Menguji fitur untuk menghapus produk.
     */
    public function test_can_delete_product()
    {
        // Membuat pengguna dan login
        $user = User::factory()->create();
        $this->actingAs($user);

        // Membuat kategori dan gambar produk yang akan dihapus
        $category = Category::factory()->create();
        $image = UploadedFile::fake()->image('oldimage.jpg', 600, 600);
        $imageName = $image->hashName();
        $image->storeAs('images', $imageName);

        // Membuat produk baru untuk diuji penghapusannya
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'name' => 'Test Product to Delete',
            'description' => 'This product will be deleted.',
            'qty' => 100,
            'price' => 50000,
            'image' => '/images/' . $imageName,
        ]);

        // Pastikan gambar ada sebelum produk dihapus
        Storage::disk('public')->assertExists($product->image);

        // Kirim request untuk menghapus produk
        $response = $this->delete("/products/{$product->id}");

        // Verifikasi apakah kita diarahkan setelah produk dihapus
        $response->assertRedirect('/products');

        // Pastikan produk telah dihapus dari database
        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);

        // Pastikan gambar terkait produk juga telah dihapus
        Storage::disk('public')->assertMissing($product->image);
    }
}
