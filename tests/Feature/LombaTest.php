<?php

namespace Tests\Unit;

use App\Models\Lomba;
use App\Models\KategoriLomba;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LombaTest extends TestCase
{
    use RefreshDatabase;

    public function test_lomba_can_have_multiple_kategori_lombas()
    {
        $lomba = Lomba::factory()->create();
        $kategoriLombas = KategoriLomba::factory(3)->create(['lomba_id' => $lomba->id]);

        $this->assertCount(3, $lomba->kategoriLombas);
        $this->assertTrue($lomba->kategoriLombas->contains($kategoriLombas->first()));
    }
}
