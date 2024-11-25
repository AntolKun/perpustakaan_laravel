<?php

namespace Tests\Unit;

use App\Models\Penilaian;
use App\Models\KategoriLomba;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PenilaianTest extends TestCase
{
    use RefreshDatabase;

    public function test_penilaian_belongs_to_kategori_lomba()
    {
        $kategoriLomba = KategoriLomba::factory()->create();
        $penilaian = Penilaian::factory()->create(['kategori_lomba_id' => $kategoriLomba->id]);

        $this->assertEquals($kategoriLomba->id, $penilaian->kategoriLomba->id);
    }
}
