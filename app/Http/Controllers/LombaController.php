<?php

namespace App\Http\Controllers;

use App\Models\Lomba;
use App\Models\KategoriLomba;
use App\Models\PendaftaranLomba;
use App\Models\NilaiSiswa;

class LombaController extends Controller
{
  public function index()
  { 
    $lombas = Lomba::all();
    return view('Lomba', compact('lombas'));
  }

  public function detail($id)
  {
    $lomba = Lomba::findOrFail($id);
    $kategoriLombas = KategoriLomba::where('lomba_id', $id)->get();

    return view('DetailLomba', compact('lomba', 'kategoriLombas'));
  }

  public function showPeserta($id)
  {
    // Cari lomba berdasarkan ID
    $lomba = Lomba::findOrFail($id);

    // Dapatkan daftar peserta yang mendaftar pada lomba ini
    $peserta = PendaftaranLomba::whereHas('kategoriLomba', function ($query) use ($id) {
      $query->where('lomba_id', $id);
    })->with('kategoriLomba')->get();

    return view('PesertaLomba', compact('lomba', 'peserta'));
  }

  public function pengumumanPemenang($id)
  {
    $lomba = Lomba::findOrFail($id);

    // Dapatkan semua kategori lomba yang terkait dengan lomba ini
    $kategoriLombas = KategoriLomba::where('lomba_id', $id)->get();
    $winners = []; // Array untuk menyimpan pemenang per kategori

    // Loop untuk mengambil 3 pemenang tertinggi per kategori
    foreach ($kategoriLombas as $kategori) {
      $topWinners = NilaiSiswa::where('kategori_lomba_id', $kategori->id)
        ->orderBy('total_nilai', 'desc')
        ->take(3) // Ambil 3 peserta teratas
        ->with('pendaftaranLomba') // Eager load untuk mendapatkan data peserta
        ->get();

      // Simpan pemenang ke dalam array berdasarkan kategori
      $winners[$kategori->nama_kategori] = $topWinners;
    }

    return view('PengumumanPemenang', compact('lomba', 'winners'));
  }

}
