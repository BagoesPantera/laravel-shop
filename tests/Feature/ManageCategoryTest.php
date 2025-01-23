<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageCategoryTest extends TestCase
{
    // Trait RefreshDatabase digunakan untuk memastikan database di-reset setelah setiap pengujian
    use RefreshDatabase;

    /**
     * Test untuk memastikan pengguna dapat membuat kategori baru.
     *
     * @return void
     */
    public function test_can_create_category()
    {
        // Membuat pengguna baru dengan factory
        $user = User::factory()->create();

        // Login sebagai pengguna yang baru dibuat
        $this->actingAs($user);

        // Mengakses halaman untuk membuat kategori
        $response = $this->get('/categories/create');
        $response->assertStatus(200); // Memastikan halaman dapat dimuat dengan status 200

        // Mengirimkan data untuk membuat kategori baru
        $response = $this->post('/categories', [
            'name' => "Test Category", // Nama kategori yang ingin dibuat
        ]);

        // Memastikan setelah berhasil membuat kategori, pengguna diarahkan kembali ke halaman kategori
        $response->assertRedirect('/categories');

        // Memastikan data kategori yang baru dibuat ada di database
        $this->assertDatabaseHas('categories', [
            'name' => "Test Category"
        ]);
    }

    /**
     * Test untuk memastikan pengguna dapat membaca kategori.
     *
     * @return void
     */
    public function test_can_read_category()
    {
        // Membuat pengguna baru
        $user = User::factory()->create();
        $this->actingAs($user);

        // Membuat kategori baru
        $category = Category::factory()->create();

        // Mengakses halaman kategori tertentu berdasarkan ID
        $response = $this->get('/categories/' . $category->id);

        // Memastikan halaman kategori dapat dimuat dengan status 200
        $response->assertStatus(200);
    }

    /**
     * Test untuk memastikan pengguna dapat memperbarui kategori.
     *
     * @return void
     */
    public function test_can_update_category()
    {
        // Membuat pengguna baru
        $user = User::factory()->create();
        $this->actingAs($user);

        // Membuat kategori baru untuk diperbarui
        $category = Category::factory()->create();

        // Mengakses halaman untuk mengedit kategori
        $response = $this->get('/categories/' . $category->id . '/edit');
        $response->assertStatus(200); // Memastikan halaman edit dapat dimuat dengan status 200

        // Mengirimkan permintaan untuk memperbarui nama kategori
        $response = $this->put('/categories/' . $category->id, [
            'name' => "Updated Test Category", // Nama kategori yang baru
        ]);

        // Memastikan setelah memperbarui, pengguna diarahkan kembali ke halaman kategori
        $response->assertRedirect('/categories');

        // Memastikan bahwa nama kategori di database telah diperbarui
        $this->assertDatabaseHas('categories', [
            'name' => "Updated Test Category"
        ]);
    }

    /**
     * Test untuk memastikan pengguna dapat menghapus kategori.
     *
     * @return void
     */
    public function test_can_delete_category()
    {
        // Membuat pengguna baru
        $user = User::factory()->create();
        $this->actingAs($user);

        // Membuat kategori baru untuk dihapus
        $category = Category::factory()->create();

        // Mengirimkan permintaan untuk menghapus kategori
        $response = $this->delete('/categories/' . $category->id);

        // Memastikan setelah penghapusan, pengguna diarahkan kembali ke halaman kategori
        $response->assertRedirect('/categories');

        // Memastikan kategori telah dihapus dari database
        $this->assertDatabaseMissing('categories', [
            'id' => $category->id
        ]);
    }
}
