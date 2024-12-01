<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';

    protected $fillable = [
        'buku_id',
        'user_id',
        'email',
        'jurusan',
        'nisn',
        'username',
        'nama',
        'kelas',
        'status',
        'tanggal_pinjam',
        'tanggal_pengembalian'
    ];

    // Relationship with User and Buku models
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class);
    }

    // Function to calculate potential denda
    public function potensiDenda()
    {
        if ($this->pengembalian) {
            return $this->pengembalian->denda;
        }

        return Pengembalian::calculateDenda($this->tanggal_pengembalian, now());
    }
}
