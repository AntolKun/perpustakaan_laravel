<?php

namespace App\Http\Controllers;

use App\Models\NilaiSiswa;
use App\Models\PendaftaranLomba;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class AdminNilaiSiswaController extends Controller
{
  public function show($pendaftaran_id, $kategori_lomba_id)
  {
    $peserta = PendaftaranLomba::findOrFail($pendaftaran_id);
    $penilaian = Penilaian::where('kategori_lomba_id', $kategori_lomba_id)->first();
    $nilaiSiswa = NilaiSiswa::where('pendaftaran_id', $pendaftaran_id)->where('kategori_lomba_id', $kategori_lomba_id)->first();

    return view('admin.lomba.kategori.peserta.nilaiPeserta.NilaiSiswa', compact('peserta', 'penilaian', 'kategori_lomba_id', 'nilaiSiswa'));
  }


  public function store(Request $request)
  {
    $request->validate([
      'field_1' => 'required|integer|min:0|max:100',
      'field_2' => 'required|integer|min:0|max:100',
      'field_3' => 'required|integer|min:0|max:100',
      'field_4' => 'required|integer|min:0|max:100',
    ]);

    $total_nilai =
      ($request->field_1 * 0.25) + // Field 1 bobot 25%
      ($request->field_2 * 0.35) + // Field 2 bobot 35%
      ($request->field_3 * 0.25) + // Field 3 bobot 25%
      ($request->field_4 * 0.15);  // Field 4 bobot 15%

    // Update atau buat data baru
    $nilaiSiswa = NilaiSiswa::updateOrCreate(
      [
        'pendaftaran_id' => $request->pendaftaran_id,
        'kategori_lomba_id' => $request->kategori_lomba_id,
      ],
      [
        'field_1' => $request->field_1,
        'field_2' => $request->field_2,
        'field_3' => $request->field_3,
        'field_4' => $request->field_4,
        'total_nilai' => $total_nilai,
      ]
    );

    return redirect()->route('adminLomba.kategori.peserta', [
      'lomba' => $request->lomba_id, 
      'kategori' => $request->kategori_lomba_id 
    ])->with('success', 'Nilai berhasil disimpan.');
  }

}
