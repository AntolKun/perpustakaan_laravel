<?php

namespace Tests\Unit;

use App\Models\KategoriLomba;
use App\Models\Lomba;
use App\Models\Penilaian;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KategoriLombaTest extends TestCase
{
    use RefreshDatabase;

    public function test_kategori_lomba_belongs_to_lomba()
    {
        $lomba = Lomba::factory()->create();
        $kategoriLomba = KategoriLomba::factory()->create(['lomba_id' => $lomba->id]);

        $this->assertEquals($lomba->id, $kategoriLomba->lomba->id);
    }

    public function test_kategori_lomba_can_have_multiple_penilaians()
    {
        $kategoriLomba = KategoriLomba::factory()->create();
        $penilaians = Penilaian::factory(2)->create(['kategori_lomba_id' => $kategoriLomba->id]);

        $this->assertCount(2, $kategoriLomba->penilaians);
    }
}
