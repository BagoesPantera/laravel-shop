<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageCategoryTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_can_create_category()
    {
        // Membuat pengguna baru dengan username
        $user = User::factory()->create();

        // Login sebagai pengguna
        $this->actingAs($user);

        $response = $this->get('/categories/create');

        $response->assertStatus(200);

        $response = $this->post('/categories', [
            'name' => "Test Category",
        ]);

        $response->assertRedirect('/categories');

        $this->assertDatabaseHas('categories', [
            'name' => "Test Category"
        ]);
    }

    public function test_can_read_category()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $category = Category::factory()->create();
        $response = $this->get('/categories/' . $category->id);
        $response->assertStatus(200);
    }

    public function test_can_update_category()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $category = Category::factory()->create();
        $response = $this->get('/categories/' . $category->id . '/edit');
        $response->assertStatus(200);
        $response = $this->put('/categories/' . $category->id, [
            'name' => "Updated Test Category",
        ]);
        $response->assertRedirect('/categories');
        $this->assertDatabaseHas('categories', [
            'name' => "Updated Test Category"
        ]);
    }

    public function test_can_delete_category()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $category = Category::factory()->create();
        $response = $this->delete('/categories/' . $category->id);
        $response->assertRedirect('/categories');
        $this->assertDatabaseMissing('categories', [
            'id' => $category->id
        ]);
    }
}
