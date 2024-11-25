<?php

namespace Database\Factories;

use App\Models\KategoriLomba;
use App\Models\Lomba;
use Illuminate\Database\Eloquent\Factories\Factory;

class KategoriLombaFactory extends Factory
{
    protected $model = KategoriLomba::class;

    public function definition()
    {
        return [
            'lomba_id' => Lomba::factory(),
            'nama_kategori' => $this->faker->words(2, true),
        ];
    }
}
