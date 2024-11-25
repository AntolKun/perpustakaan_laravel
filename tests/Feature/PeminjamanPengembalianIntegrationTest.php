<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Carbon\Carbon;

class PeminjamanPengembalianIntegrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_complete_peminjaman_and_pengembalian()
    {
        // Membuat data peminjaman
        $peminjaman = Peminjaman::factory()->create();

        // Membuat data pengembalian berdasarkan peminjaman
        $pengembalian = Pengembalian::factory()->create([
            'peminjaman_id' => $peminjaman->id,
            'tanggal_dikembalikan' => Carbon::now()->format('Y-m-d'),
            'denda' => 0,
        ]);

        // Periksa data peminjaman dan pengembalian di database
        $this->assertDatabaseHas('peminjamans', ['id' => $peminjaman->id]);
        $this->assertDatabaseHas('pengembalians', ['id' => $pengembalian->id]);

        // Periksa relasi
        $this->assertEquals($pengembalian->peminjaman->id, $peminjaman->id);
    }
}
