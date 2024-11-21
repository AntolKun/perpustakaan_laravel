<?php

namespace Tests\Feature;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    }

    /** @test */
    public function it_displays_the_registration_form()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertViewIs('auth.Register'); // Corrected view name
    }

    /** @test */
    public function it_requires_all_fields_to_register()
    {
        $response = $this->post('/post-register', []);

        $response->assertSessionHasErrors([
            'nama',
            'email',
            'nisn',
            'kelas',
            'nomor_telepon',
            'password',
        ]);
    }

    /** @test */
    public function it_validates_email_uniqueness()
    {
        User::factory()->create(['email' => 'existing@example.com']);

        $response = $this->post('/post-register', [
            'nama' => 'Test User',
            'email' => 'existing@example.com',
            'nisn' => '1234567890',
            'kelas' => '10A',
            'nomor_telepon' => '081234567890',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function it_validates_nisn_uniqueness()
    {
        Siswa::factory()->create(['nisn' => '1234567890']);

        $response = $this->post('/post-register', [
            'nama' => 'Test User',
            'email' => 'test@example.com',
            'nisn' => '1234567890',
            'kelas' => '10A',
            'nomor_telepon' => '081234567890',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors(['nisn']);
    }

    /** @test */
    public function it_creates_a_user_and_siswa_on_successful_registration()
    {
        $response = $this->post('/post-register', [
            'nama' => 'Test User',
            'email' => 'test@example.com',
            'nisn' => '1234567890',
            'kelas' => '10A',
            'nomor_telepon' => '081234567890',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHas('success', 'Registrasi berhasil, silahkan login.');

        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
        $this->assertDatabaseHas('siswa', ['nisn' => '1234567890']);
    }

    /** @test */
    public function it_handles_optional_photo_field()
    {
        $response = $this->post('/post-register', [
            'nama' => 'Test User',
            'email' => 'test@example.com',
            'nisn' => '1122334455',
            'kelas' => '10A',
            'nomor_telepon' => '081234567890',
            'password' => 'password',
            'password_confirmation' => 'password',
            'foto' => null,
        ]);

        $response->assertRedirect('/login');

        $this->assertDatabaseHas('siswa', [
            'nisn' => '1122334455',
            'foto' => null,
        ]);
    }
}
