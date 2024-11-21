<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use App\Models\Siswa;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_have_one_admin()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $admin = Admin::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(Admin::class, $user->admin);
        $this->assertEquals($user->id, $admin->user_id);
    }

    public function test_user_can_have_one_juri()
    {
        $user = User::factory()->create(['role' => 'juri']);
        $admin = Admin::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(Admin::class, $user->admin);
        $this->assertEquals($user->id, $admin->user_id);
    }

    public function test_user_can_have_one_pustakawan()
    {
        $user = User::factory()->create(['role' => 'pustakawan']);
        $admin = Admin::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(Admin::class, $user->admin);
        $this->assertEquals($user->id, $admin->user_id);
    }

    public function test_user_can_have_one_siswa()
    {
        $user = User::factory()->create(['role' => 'siswa']);
        $siswa = Siswa::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(Siswa::class, $user->siswa);
        $this->assertEquals($user->id, $siswa->user_id);
    }
}
