<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SiswaTest extends TestCase
{
    use RefreshDatabase;

    public function test_siswa_belongs_to_user()
    {
        $user = User::factory()->create(['role' => 'siswa']);
        $siswa = Siswa::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $siswa->user);
        $this->assertEquals($user->id, $siswa->user->id);
    }
}
