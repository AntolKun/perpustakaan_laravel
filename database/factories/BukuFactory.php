<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BukuFactory extends Factory
{
    protected $model = \App\Models\Buku::class;

    public function definition()
    {
        return [
            'judulbuku' => $this->faker->sentence(3),
            'isbn' => $this->faker->isbn13(),
            'penerbit' => $this->faker->company(),
            'tahun_terbit' => $this->faker->year(),
            'stok' => $this->faker->numberBetween(1, 100),
            'penulis' => $this->faker->name(),
            'halaman' => $this->faker->numberBetween(50, 500),
            'deskripsi' => $this->faker->text(255),
            'gambar' => $this->faker->imageUrl(200, 300, 'books'),
            'kategori_id' => \App\Models\KategoriBuku::factory(), // Relasi ke kategori
        ];
    }
}
