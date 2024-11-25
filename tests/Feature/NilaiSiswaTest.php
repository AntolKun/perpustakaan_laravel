<?php

namespace Tests\Unit;

use App\Models\NilaiSiswa;
use App\Models\PendaftaranLomba;
use App\Models\KategoriLomba;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NilaiSiswaTest extends TestCase
{
    use RefreshDatabase;

    public function test_nilai_siswa_belongs_to_pendaftaran_lomba()
    {
        $pendaftaran = PendaftaranLomba::factory()->create();
        $nilaiSiswa = NilaiSiswa::factory()->create(['pendaftaran_id' => $pendaftaran->id]);

        $this->assertEquals($pendaftaran->id, $nilaiSiswa->pendaftaranLomba->id);
    }

    public function test_nilai_siswa_belongs_to_kategori_lomba()
    {
        $kategoriLomba = KategoriLomba::factory()->create();
        $nilaiSiswa = NilaiSiswa::factory()->create(['kategori_lomba_id' => $kategoriLomba->id]);

        $this->assertEquals($kategoriLomba->id, $nilaiSiswa->kategoriLomba->id);
    }
}
