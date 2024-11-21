<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\KategoriBuku;

class BukuFactory extends Factory
{
    protected $model = \App\Models\Buku::class;

    public function definition()
    {
        return [
            'judulbuku' => $this->faker->sentence(3),
            'isbn' => $this->faker->isbn13,
            'penerbit' => $this->faker->company,
            'tahun_terbit' => $this->faker->year,
            'stok' => $this->faker->numberBetween(1, 100),
            'penulis' => $this->faker->name,
            'halaman' => $this->faker->numberBetween(100, 500),
            'deskripsi' => $this->faker->paragraph,
            'gambar' => $this->faker->imageUrl,
            'kategori_id' => KategoriBuku::factory(), // Relasi ke KategoriBuku
        ];
    }
}
