<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Carbon\Carbon;

class PengembalianTest extends TestCase
{
    use RefreshDatabase;

    public function test_pengembalian_creation()
    {
        // Membuat data peminjaman
        $peminjaman = Peminjaman::factory()->create();

        // Membuat data pengembalian
        $pengembalian = Pengembalian::factory()->create([
            'peminjaman_id' => $peminjaman->id,
        ]);

        // Periksa apakah data masuk ke database
        $this->assertDatabaseHas('pengembalians', [
            'id' => $pengembalian->id,
            'peminjaman_id' => $peminjaman->id,
        ]);
    }

    public function test_pengembalian_denda_calculation()
    {
        // Simulasi tanggal pengembalian yang lewat waktu
        $tanggalPengembalian = Carbon::now()->subDays(3);
        $expectedDenda = 3 * 2500; // 3 hari * Rp 2500

        // Hitung denda
        $denda = Pengembalian::calculateDenda($tanggalPengembalian);

        // Periksa apakah denda sesuai
        $this->assertEquals($expectedDenda, $denda);
    }

    public function test_pengembalian_relations()
    {
        $peminjaman = Peminjaman::factory()->create();

        $pengembalian = Pengembalian::factory()->create([
            'peminjaman_id' => $peminjaman->id,
        ]);

        // Periksa relasi pengembalian dengan peminjaman
        $this->assertEquals($peminjaman->id, $pengembalian->peminjaman->id);
    }
}
