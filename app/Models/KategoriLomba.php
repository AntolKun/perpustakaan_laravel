<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriLomba extends Model
{
    use HasFactory;

    protected $fillable = ['lomba_id', 'nama_kategori'];

    public function lomba()
    {
        return $this->belongsTo(Lomba::class);
    }

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }
}

