<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftaranLomba;
use App\Models\KategoriLomba;

class PendaftaranLombaController extends Controller
{
  public function store(Request $request, $id)
  {
    $request->validate([
      'nama' => 'required|string|max:255',
      'kelas' => 'required|string|max:255',
      'kategori_lomba_id' => 'required|exists:kategori_lombas,id',
      'nomor_telepon' => 'required|string|max:15',
      'bukti_pembayaran' => 'required|file|mimes:jpeg,png,jpg,pdf',
    ]);

    $buktiPembayaranPath = null;
    if ($request->hasFile('bukti_pembayaran')) {
      $buktiPembayaran = $request->file('bukti_pembayaran');
      $buktiPembayaranName = time() . '_' . $buktiPembayaran->getClientOriginalName();
      $buktiPembayaran->move(public_path('bukti_pembayaran'), $buktiPembayaranName);
      $buktiPembayaranPath = $buktiPembayaranName;
    }

    $kategoriLomba = KategoriLomba::findOrFail($request->kategori_lomba_id);
    $lombaId = $kategoriLomba->lomba_id;

    PendaftaranLomba::create([
      'kategori_lomba_id' => $request->kategori_lomba_id,
      'lomba_id' => $lombaId,
      'nama' => $request->nama,
      'kelas' => $request->kelas,
      'nomor_telepon' => $request->nomor_telepon,
      'bukti_pembayaran' => $buktiPembayaranPath,
    ]);

    return redirect()->back()->with('success', 'Pendaftaran berhasil!');
  }
}
