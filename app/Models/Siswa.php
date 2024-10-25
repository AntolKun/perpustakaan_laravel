<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
  use HasFactory;

  protected $table = 'siswa';

  protected $fillable = [
    'user_id',
    'nama',
    'nisn',
    'kelas',
    'nomor_telepon',
    'foto',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
