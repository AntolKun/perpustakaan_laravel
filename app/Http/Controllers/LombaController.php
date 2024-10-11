<?php

namespace App\Http\Controllers;

use App\Models\Lomba;
use App\Models\KategoriLomba;
use App\Models\PendaftaranLomba;

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
}
