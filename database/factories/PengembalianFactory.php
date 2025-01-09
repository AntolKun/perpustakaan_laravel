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
            'peminjaman_id' => Peminjaman::factory(),
            'tanggal_dikembalikan' => Carbon::now(), // Tetap sebagai objek Carbon
            'denda' => Pengembalian::calculateDenda(
                $tanggalPengembalian,
                Carbon::now() // Pastikan ini Carbon
            ),
            'status' => 'selesai',
        ];
    }

    public static function calculateDenda($tanggalPengembalian, $tanggalDikembalikan)
    {
        // Log nilai untuk debugging
        logger()->info('Tanggal Pengembalian:', ['tanggalPengembalian' => $tanggalPengembalian]);
        logger()->info('Tanggal Dikembalikan:', ['tanggalDikembalikan' => $tanggalDikembalikan]);

        $tanggalPengembalian = $tanggalPengembalian instanceof Carbon
            ? $tanggalPengembalian
            : Carbon::parse($tanggalPengembalian);

        $tanggalDikembalikan = $tanggalDikembalikan instanceof Carbon
            ? $tanggalDikembalikan
            : Carbon::parse($tanggalDikembalikan);

        logger()->info('Parsed Tanggal Pengembalian:', ['tanggalPengembalian' => $tanggalPengembalian]);
        logger()->info('Parsed Tanggal Dikembalikan:', ['tanggalDikembalikan' => $tanggalDikembalikan]);

        if ($tanggalDikembalikan->greaterThan($tanggalPengembalian)) {
            $selisihHari = $tanggalPengembalian->diffInDays($tanggalDikembalikan);
            logger()->info('Selisih Hari:', ['selisihHari' => $selisihHari]);
            return $selisihHari * 2500;
        }

        return 0;
    }

}
