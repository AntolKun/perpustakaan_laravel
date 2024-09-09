<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Seeder;

class BukusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Buku::create([
            'judulbuku' => 'Contoh Buku 1',
            'isbn' => '9781234567897',
            'penerbit' => 'Penerbit ABC',
            'tahun_terbit' => 2020,
            'stok' => 10,
            'penulis' => 'Penulis Satu',
            'halaman' => 300,
            'deskripsi' => 'Deskripsi buku contoh 1',
            'gambar' => 'public/buku_images/sample1.jpg',
        ]);

        Buku::create([
            'judulbuku' => 'Contoh Buku 2',
            'isbn' => '9789876543210',
            'penerbit' => 'Penerbit XYZ',
            'tahun_terbit' => 2022,
            'stok' => 5,
            'penulis' => 'Penulis Dua',
            'halaman' => 150,
            'deskripsi' => 'Deskripsi buku contoh 2',
            'gambar' => 'public/buku_images/sample2.jpg',
        ]);
    }
}
