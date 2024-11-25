<?php

namespace Tests\Unit;

use App\Models\PendaftaranLomba;
use App\Models\Lomba;
use App\Models\KategoriLomba;
use App\Models\NilaiSiswa;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PendaftaranLombaTest extends TestCase
{
    use RefreshDatabase;

    public function test_pendaftaran_lomba_belongs_to_lomba()
    {
        $lomba = Lomba::factory()->create();
        $pendaftaran = PendaftaranLomba::factory()->create(['lomba_id' => $lomba->id]);

        $this->assertEquals($lomba->id, $pendaftaran->lomba->id);
    }

    public function test_pendaftaran_lomba_belongs_to_kategori_lomba()
    {
        $kategoriLomba = KategoriLomba::factory()->create();
        $pendaftaran = PendaftaranLomba::factory()->create(['kategori_lomba_id' => $kategoriLomba->id]);

        $this->assertEquals($kategoriLomba->id, $pendaftaran->kategoriLomba->id);
    }

    public function test_pendaftaran_lomba_has_one_nilai_siswa()
    {
        $pendaftaran = PendaftaranLomba::factory()->create();
        $nilaiSiswa = NilaiSiswa::factory()->create(['pendaftaran_id' => $pendaftaran->id]);

        $this->assertEquals($nilaiSiswa->id, $pendaftaran->nilaiSiswa->id);
    }
}
