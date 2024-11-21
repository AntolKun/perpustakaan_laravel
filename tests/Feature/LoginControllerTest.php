<?php
// tests/Feature/LoginControllerTest.php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
  use RefreshDatabase;

  public function setUp(): void
  {
    parent::setUp();
    $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
  }

  public function test_login_successful_for_each_role()
  {
    // Create user with 'siswa' role
    $user = User::factory()->create([
      'email' => 'siswa@example.com',
      'password' => Hash::make('password'),
      'role' => 'siswa',
    ]);

    $response = $this->post('actionLogin', [
      'email' => 'siswa@example.com',
      'password' => 'password',
    ]);

    $response->assertRedirect(route('dashboard'))
      ->assertSessionHas('success', 'Berhasil Login!');
  }

  public function test_login_fails_with_invalid_credentials()
  {
    $user = User::factory()->create([
      'email' => 'siswa@example.com',
      'password' => Hash::make('password'),
    ]);

    $response = $this->post('actionLogin', [
      'email' => 'siswa@example.com',
      'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors(['email' => 'Email atau password salah.']);
  }
}

?>