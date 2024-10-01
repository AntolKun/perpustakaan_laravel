<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_lomba_id',
        'field_1',
        'field_2',
        'field_3',
        'field_4'
    ];

    public function kategoriLomba()
    {
        return $this->belongsTo(KategoriLomba::class);
    }
}

