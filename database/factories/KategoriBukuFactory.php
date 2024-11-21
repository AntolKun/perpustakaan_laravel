<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KategoriBukuFactory extends Factory
{
    protected $model = \App\Models\KategoriBuku::class;

    public function definition()
    {
        return [
            'nama_kategori' => $this->faker->word,
        ];
    }
}
