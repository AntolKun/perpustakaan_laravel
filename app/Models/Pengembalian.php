<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pengembalian extends Model
{
  use HasFactory;

  protected $table = 'pengembalians';

  protected $fillable = [
    'peminjaman_id',
    'tanggal_dikembalikan',
    'denda',
    'status',
  ];

  // Relationship with Peminjaman model
  public function peminjaman()
  {
    return $this->belongsTo(Peminjaman::class);
  }

  // Function to calculate penalty based on overdue days
  // public static function calculateDenda($tanggalPengembalian)
  // {
  //   $now = Carbon::now();
  //   if ($now->greaterThan($tanggalPengembalian)) {
  //     $diff = $now->diffInDays($tanggalPengembalian);
  //     return $diff * 2500; // Rp. 1000 per day overdue
  //   }
  //   return 0;
  // }

  public static function calculateDenda($tanggalPengembalian, $tanggalDikembalikan)
  {
    // Jika tanggal dikembalikan lebih dari tanggal pengembalian yang seharusnya
    if ($tanggalDikembalikan->greaterThan($tanggalPengembalian)) {
      // Hitung selisih hari keterlambatan
      $selisihHari = $tanggalPengembalian->diffInDays($tanggalDikembalikan);
      // Kalikan dengan tarif denda per hari
      return $selisihHari * 2500; // Rp 2500 per hari keterlambatan
    }

    // Tidak ada denda jika tidak terlambat
    return 0;
  }

}
