<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Buku;
use App\Models\KategoriBuku;

class AdminBukuControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    }

    public function test_can_create_buku()
    {
        $kategori = KategoriBuku::factory()->create(); // Assuming a kategori is needed
        $data = [
            'judulbuku' => 'Book Title',
            'isbn' => '1234567890123',
            'penerbit' => 'Publisher Name',
            'tahun_terbit' => 2024,
            'stok' => 10,
            'penulis' => 'Author Name',
            'halaman' => 100,
            'deskripsi' => 'Book description.',
            'gambar' => 'book.jpg',
            'kategori_id' => $kategori->id,
        ];

        $response = $this->post(route('storeBuku'), $data);

        // $response->assertRedirect('/adminBuku')); // Assuming you're redirected to the adminBuku route
        $this->assertDatabaseHas('bukus', $data); // Check if the book is stored in the database
    }

    public function test_can_update_buku()
    {
        $kategori = KategoriBuku::factory()->create();
        $buku = Buku::factory()->create(['kategori_id' => $kategori->id]);
        $updatedData = [
            'judulbuku' => 'Updated Book Title',
            'isbn' => '9876543210987',
            'penerbit' => 'Updated Publisher',
            'tahun_terbit' => 2025,
            'stok' => 5,
            'penulis' => 'Updated Author',
            'halaman' => 150,
            'deskripsi' => 'Updated description.',
            'gambar' => 'updated_book.jpg',
            'kategori_id' => $kategori->id,
        ];

        $response = $this->put(route('bukuEdit', $buku->id), $updatedData);

        // $response->assertRedirect('/adminBuku'); // Assuming the redirect after updating is to the adminBuku route
        $this->assertDatabaseHas('bukus', $updatedData); // Check if the book's updated data exists in the database
    }

    public function test_can_delete_buku()
    {
        $buku = Buku::factory()->create();

        $response = $this->delete(route('bukuDelete', $buku->id));

        // $response->assertRedirect('/adminBuku'); // Assuming the redirect after deletion is to the adminBuku route
        $this->assertDatabaseMissing('bukus', ['id' => $buku->id]); // Ensure the book is deleted from the database
    }

}
