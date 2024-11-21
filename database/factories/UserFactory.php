<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // atau gunakan Hash::make('password')
            'role' => 'siswa', // atau nilai default lainnya
        ];
    }
}
