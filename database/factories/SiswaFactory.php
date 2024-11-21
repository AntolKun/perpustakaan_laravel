<?php

namespace Database\Factories;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiswaFactory extends Factory
{
  protected $model = Siswa::class;

  public function definition()
  {
    return [
      'user_id' => User::factory(),
      'nama' => $this->faker->name,
      'nisn' => $this->faker->unique()->numerify('##########'),
      'kelas' => '10A', // atau nilai default lainnya
      'nomor_telepon' => $this->faker->phoneNumber,
      'foto' => $this->faker->imageUrl(200, 200, 'people'),
    ];
  }
}
