<?php

namespace Database\Factories;

use App\Models\NilaiSiswa;
use App\Models\PendaftaranLomba;
use App\Models\KategoriLomba;
use Illuminate\Database\Eloquent\Factories\Factory;

class NilaiSiswaFactory extends Factory
{
    protected $model = NilaiSiswa::class;

    public function definition()
    {
        return [
            'pendaftaran_id' => PendaftaranLomba::factory(),
            'kategori_lomba_id' => KategoriLomba::factory(),
            'field_1' => $this->faker->numberBetween(1, 100),
            'field_2' => $this->faker->numberBetween(1, 100),
            'field_3' => $this->faker->numberBetween(1, 100),
            'field_4' => $this->faker->numberBetween(1, 100),
            'total_nilai' => $this->faker->numberBetween(300, 400), // Example total
        ];
    }
}
