<?php

namespace Database\Factories;

use App\Models\PendaftaranLomba;
use App\Models\Lomba;
use App\Models\KategoriLomba;
use Illuminate\Database\Eloquent\Factories\Factory;

class PendaftaranLombaFactory extends Factory
{
    protected $model = PendaftaranLomba::class;

    public function definition()
    {
        return [
            'lomba_id' => Lomba::factory(),
            'kategori_lomba_id' => KategoriLomba::factory(),
            'nama' => $this->faker->name(),
            'kelas' => $this->faker->randomElement(['10', '11', '12']),
            'nomor_telepon' => $this->faker->phoneNumber(),
            'bukti_pembayaran' => $this->faker->imageUrl(640, 480, 'payment'),
        ];
    }
}
