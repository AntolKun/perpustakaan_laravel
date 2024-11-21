<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\KategoriBuku;

class AdminKategoriBukuControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    }

    public function test_can_create_kategori_buku()
    {
        $data = [
            'nama_kategori' => 'New Category',
        ];

        $response = $this->post(route('kategori-buku.store'), $data);

        $response->assertRedirect(route('adminKategori')); // Assuming you're redirected to the adminKategori route
        $this->assertDatabaseHas('kategori_buku', $data); // Check if the category is created in the database
    }

    public function test_can_update_kategori_buku()
    {
        $kategori = KategoriBuku::factory()->create();
        $updatedData = [
            'nama_kategori' => 'Updated Category',
        ];

        $response = $this->put(route('kategori-buku.update', $kategori->id), $updatedData);

        $response->assertRedirect(route('adminKategori')); // Assuming the redirect after updating is to the adminKategori route
        $this->assertDatabaseHas('kategori_buku', $updatedData); // Check if the category's updated data exists in the database
    }

    public function test_can_delete_kategori_buku()
    {
        $kategori = KategoriBuku::factory()->create();

        $response = $this->delete(route('kategori-buku.destroy', $kategori->id));

        $response->assertRedirect(route('adminKategori')); // Assuming the redirect after deletion is to the adminKategori route
        $this->assertDatabaseMissing('kategori_buku', ['id' => $kategori->id]); // Ensure the category is deleted from the database
    }
}
