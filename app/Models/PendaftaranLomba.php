<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranLomba extends Model
{
    use HasFactory;

    protected $fillable = [
        'lomba_id',
        'kategori_lomba_id',
        'nama',
        'kelas',
        'nomor_telepon',
        'bukti_pembayaran'
    ];

    public function lomba()
    {
        return $this->belongsTo(Lomba::class);
    }

    public function kategoriLomba()
    {
        return $this->belongsTo(KategoriLomba::class);
    }

    public function nilaiSiswa()
    {
        return $this->hasOne(NilaiSiswa::class, 'pendaftaran_id');
    }
}

