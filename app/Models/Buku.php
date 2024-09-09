<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'judulbuku',
        'isbn',
        'penerbit',
        'tahun_terbit',
        'stok',
        'penulis',
        'halaman',
        'deskripsi',
        'gambar'
    ];
}
