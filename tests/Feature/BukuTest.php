<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Buku;
use App\Models\KategoriBuku;

class BukuTest extends TestCase
{
    use RefreshDatabase;

    public function test_buku_creation()
    {
        $kategori = KategoriBuku::factory()->create();

        $buku = Buku::factory()->create([
            'judulbuku' => 'Laravel for Beginners',
            'kategori_id' => $kategori->id,
        ]);

        $this->assertDatabaseHas('bukus', [
            'id' => $buku->id,
            'judulbuku' => 'Laravel for Beginners',
            'kategori_id' => $kategori->id,
        ]);
    }

    public function test_buku_belongs_to_kategori()
    {
        $kategori = KategoriBuku::factory()->create(['nama_kategori' => 'Teknologi']);

        $buku = Buku::factory()->create(['kategori_id' => $kategori->id]);

        $this->assertEquals('Teknologi', $buku->kategori->nama_kategori);
    }

    public function test_buku_requires_valid_attributes()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        // Coba membuat buku tanpa atribut wajib
        Buku::factory()->create(['judulbuku' => null]);
    }
}
