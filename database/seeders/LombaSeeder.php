<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lomba;

class LombaSeeder extends Seeder
{
    public function run()
    {
        Lomba::create([
            'judul' => 'Lomba Membaca Puisi',
            'deskripsi' => 'Lomba membaca puisi tingkat nasional.',
            'gambar' => 'puisi.jpg'
        ]);
    }
}
