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
    $peminjamans = Peminjaman::with('pengembalian', 'buku')
      ->where('status', '!=', 'ditolak')
      ->get();

    return view('admin.pengembalian.AdminPengembalian', compact('peminjamans'));
  }

  // Handle pengembalian process
  public function store(Request $request, $id)
  {
    $peminjaman = Peminjaman::findOrFail($id);

    // Check if the book has already been returned
    if ($peminjaman->pengembalian) {
      return redirect()->back()->with('error', 'Buku sudah dikembalikan.');
    }

    // Create new pengembalian entry
    $pengembalian = new Pengembalian();
    $pengembalian->peminjaman_id = $peminjaman->id;
    $pengembalian->tanggal_dikembalikan = now();
    $pengembalian->denda = Pengembalian::calculateDenda(
      $peminjaman->tanggal_pengembalian,
      $pengembalian->tanggal_dikembalikan
    );
    $pengembalian->status = 'sudah dikembalikan';
    $pengembalian->save();

    return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
  }

  public function rekap(Request $request)
  {
    // Ambil bulan dan tahun dari request (default: bulan dan tahun ini)
    $bulan = $request->input('bulan', now()->month);
    $tahun = $request->input('tahun', now()->year);

    // Query pengembalian berdasarkan bulan dan tahun
    $pengembalians = Pengembalian::with('peminjaman.buku')
    ->whereYear('tanggal_dikembalikan', $tahun)
      ->whereMonth('tanggal_dikembalikan', $bulan)
      ->get();

    // Kirim data ke view
    return view('admin.pengembalian.RekapPengembalian', compact('pengembalians', 'bulan', 'tahun'));
  }

}
