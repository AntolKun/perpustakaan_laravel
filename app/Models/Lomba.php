<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lomba extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'deskripsi', 'gambar'];

    public function kategoriLombas()
    {
        return $this->hasMany(KategoriLomba::class, 'lomba_id');
    }

}
