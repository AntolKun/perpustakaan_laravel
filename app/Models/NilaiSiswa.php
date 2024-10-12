<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSiswa extends Model
{
  use HasFactory;

  protected $fillable = [
    'pendaftaran_id',
    'kategori_lomba_id',
    'field_1',
    'field_2',
    'field_3',
    'field_4',
    'total_nilai'
  ];

  public function kategoriLomba()
  {
    return $this->belongsTo(KategoriLomba::class);
  }

  public function pendaftaranLomba()
  {
    return $this->belongsTo(PendaftaranLomba::class, 'pendaftaran_id');
  }
}

?>