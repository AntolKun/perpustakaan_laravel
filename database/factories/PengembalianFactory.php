<?php

namespace Database\Factories;

use App\Models\Pengembalian;
use App\Models\Peminjaman;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class PengembalianFactory extends Factory
{
    protected $model = Pengembalian::class;

    public function definition()
    {
        $tanggalPinjam = Carbon::now()->subDays(rand(5, 10));
        $tanggalPengembalian = $tanggalPinjam->addDays(rand(1, 5));

        return [
            'peminjaman_id' => Peminjaman::factory(), // Membuat peminjaman terkait
            'tanggal_dikembalikan' => Carbon::now()->format('Y-m-d'),
            'denda' => Pengembalian::calculateDenda($tanggalPengembalian),
            'status' => 'selesai',
        ];
    }
}
