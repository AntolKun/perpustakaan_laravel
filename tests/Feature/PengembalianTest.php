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
        $peminjaman = Peminjaman::factory()->create([
            'tanggal_pengembalian' => Carbon::now()->subDays(5)->format('Y-m-d'),
        ]);

        // Membuat data pengembalian
        $pengembalian = Pengembalian::factory()->create([
            'peminjaman_id' => $peminjaman->id,
            'tanggal_dikembalikan' => Carbon::now()->format('Y-m-d'),
        ]);

        // Periksa apakah data pengembalian masuk ke database
        $this->assertDatabaseHas('pengembalians', [
            'id' => $pengembalian->id,
            'peminjaman_id' => $peminjaman->id,
        ]);
    }

    public function test_denda_calculation_with_late_return()
    {
        // Simulasi tanggal pengembalian dan aktual pengembalian
        $tanggalPengembalian = Carbon::now()->subDays(5); // Tanggal seharusnya dikembalikan
        $tanggalDikembalikan = Carbon::now(); // Tanggal aktual pengembalian
        $expectedDenda = 5 * 2500; // 5 hari keterlambatan x Rp 2500 per hari

        // Hitung denda
        $denda = Pengembalian::calculateDenda($tanggalPengembalian, $tanggalDikembalikan);

        // Pastikan denda sesuai dengan yang diharapkan
        $this->assertEquals($expectedDenda, $denda);
    }

    public function test_denda_calculation_without_late_return()
    {
        // Simulasi tanggal pengembalian dan aktual pengembalian
        $tanggalPengembalian = Carbon::now(); // Tanggal seharusnya dikembalikan
        $tanggalDikembalikan = Carbon::now(); // Tanggal aktual pengembalian
        $expectedDenda = 0; // Tidak ada keterlambatan

        // Hitung denda
        $denda = Pengembalian::calculateDenda($tanggalPengembalian, $tanggalDikembalikan);

        // Pastikan denda adalah 0
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
