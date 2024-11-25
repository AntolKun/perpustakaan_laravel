<?php

namespace Database\Factories;

use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Buku;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class PeminjamanFactory extends Factory
{
    protected $model = Peminjaman::class;

    public function definition()
    {
        return [
            'buku_id' => Buku::factory(), // Membuat buku terkait
            'user_id' => User::factory(), // Membuat user terkait
            'email' => $this->faker->email(),
            'jurusan' => $this->faker->randomElement(['IPA', 'IPS', 'Bahasa']),
            'nisn' => $this->faker->unique()->numerify('##########'),
            'username' => $this->faker->userName(),
            'nama' => $this->faker->name(),
            'kelas' => $this->faker->randomElement(['10', '11', '12']) . $this->faker->randomElement(['A', 'B', 'C']),
            'status' => $this->faker->randomElement(['pinjam', 'dikembalikan']),
            'tanggal_pinjam' => Carbon::now()->subDays(rand(1, 7))->format('Y-m-d'),
            'tanggal_pengembalian' => Carbon::now()->addDays(rand(1, 7))->format('Y-m-d'),
        ];
    }
}
