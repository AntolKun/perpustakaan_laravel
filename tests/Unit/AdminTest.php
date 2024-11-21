<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_belongs_to_user()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $admin = Admin::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $admin->user);
        $this->assertEquals($user->id, $admin->user->id);
    }
}
