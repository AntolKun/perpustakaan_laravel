<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
  protected $model = Admin::class;

  public function definition()
  {
    return [
      'user_id' => User::factory(),
      'nama' => $this->faker->name,
      'foto' => $this->faker->imageUrl(200, 200, 'people'),
    ];
  }
}
