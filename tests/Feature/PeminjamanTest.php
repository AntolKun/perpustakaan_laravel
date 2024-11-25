<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Buku;

class PeminjamanTest extends TestCase
{
    use RefreshDatabase;

    public function test_peminjaman_creation()
    {
        // Membuat data user dan buku
        $user = User::factory()->create();
        $buku = Buku::factory()->create();

        // Membuat data peminjaman
        $peminjaman = Peminjaman::factory()->create([
            'user_id' => $user->id,
            'buku_id' => $buku->id,
        ]);

        // Periksa apakah data masuk ke database
        $this->assertDatabaseHas('peminjamans', [
            'id' => $peminjaman->id,
            'user_id' => $user->id,
            'buku_id' => $buku->id,
        ]);
    }

    public function test_peminjaman_relations()
    {
        $user = User::factory()->create();
        $buku = Buku::factory()->create();

        $peminjaman = Peminjaman::factory()->create([
            'user_id' => $user->id,
            'buku_id' => $buku->id,
        ]);

        // Periksa relasi user
        $this->assertEquals($user->id, $peminjaman->user->id);

        // Periksa relasi buku
        $this->assertEquals($buku->id, $peminjaman->buku->id);
    }
}
