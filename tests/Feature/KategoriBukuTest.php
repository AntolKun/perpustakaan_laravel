<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\KategoriBuku;

class KategoriBukuTest extends TestCase
{
    use RefreshDatabase;

    public function test_kategori_buku_creation()
    {
        $kategori = KategoriBuku::factory()->create([
            'nama_kategori' => 'Novel',
        ]);

        $this->assertDatabaseHas('kategori_buku', [
            'id' => $kategori->id,
            'nama_kategori' => 'Novel',
        ]);
    }

    public function test_kategori_buku_can_have_multiple_books()
    {
        $kategori = KategoriBuku::factory()->create();

        $buku1 = \App\Models\Buku::factory()->create(['kategori_id' => $kategori->id]);
        $buku2 = \App\Models\Buku::factory()->create(['kategori_id' => $kategori->id]);

        $this->assertCount(2, $kategori->bukus);
        $this->assertEquals($kategori->id, $buku1->kategori->id);
        $this->assertEquals($kategori->id, $buku2->kategori->id);
    }
}
