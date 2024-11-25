<?php

namespace Database\Factories;

use App\Models\Lomba;
use Illuminate\Database\Eloquent\Factories\Factory;

class LombaFactory extends Factory
{
    protected $model = Lomba::class;

    public function definition()
    {
        return [
            'judul' => $this->faker->sentence(),
            'deskripsi' => $this->faker->paragraph(),
            'gambar' => $this->faker->imageUrl(640, 480, 'lomba'),
        ];
    }
}
