<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class AdminPengembalianController extends Controller
{
  // Show all pengembalian records
  public function index()
  {
    // ambil semua data buku yang disetujui
    $peminjamans = Peminjaman::with('pengembalian', 'buku')
      ->where('status', '!=', 'ditolak')
      ->get();

    // Pass peminjamans dengan kalkulasi denda ke view
    return view('admin.pengembalian.AdminPengembalian', compact('peminjamans'));
  }

  // Handle pengembalian process
  public function store(Request $request, $id)
  {
    $peminjaman = Peminjaman::findOrFail($id);

    // cek apakah buku sudah dikembalikan
    if ($peminjaman->pengembalian) {
      return redirect()->back()->with('error', 'Buku sudah dikembalikan.');
    }

    // buat entry pengembalian baru
    $pengembalian = new Pengembalian();
    $pengembalian->peminjaman_id = $peminjaman->id;
    $pengembalian->tanggal_dikembalikan = now();
    $pengembalian->denda = Pengembalian::calculateDenda($peminjaman->tanggal_pengembalian);
    $pengembalian->status = 'sudah dikembalikan';
    $pengembalian->save();

    return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
  }
}
