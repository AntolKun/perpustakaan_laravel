<?php

namespace Database\Factories;

use App\Models\Penilaian;
use App\Models\KategoriLomba;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenilaianFactory extends Factory
{
    protected $model = Penilaian::class;

    public function definition()
    {
        return [
            'kategori_lomba_id' => KategoriLomba::factory(),
            'field_1' => $this->faker->numberBetween(1, 100),
            'field_2' => $this->faker->numberBetween(1, 100),
            'field_3' => $this->faker->numberBetween(1, 100),
            'field_4' => $this->faker->numberBetween(1, 100),
        ];
    }
}
