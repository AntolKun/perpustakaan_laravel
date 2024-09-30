<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;

class AdminPeminjamanController extends Controller
{
  // Tampilkan daftar peminjaman yang butuh persetujuan
  public function index()
  {
    // $peminjaman = Peminjaman::where('status', 'menunggu persetujuan')->get();
    $peminjaman = Peminjaman::all();
    return view('admin.peminjaman.AdminPeminjaman', compact('peminjaman'));
  }

  // Fungsi untuk menyetujui peminjaman
  public function setujui($id)
  {
    $peminjaman = Peminjaman::findOrFail($id);
    $peminjaman->status = 'disetujui';
    $peminjaman->tanggal_pinjam = now();
    $peminjaman->tanggal_pengembalian = now()->addDays(3);
    $peminjaman->save();

    // Kurangi stok buku
    $peminjaman->buku->stok -= 1;
    $peminjaman->buku->save();

    return redirect()->back()->with('success', 'Peminjaman telah disetujui.');
  }

  // Fungsi untuk menolak peminjaman
  public function tolak($id)
  {
    $peminjaman = Peminjaman::findOrFail($id);
    $peminjaman->status = 'ditolak';
    $peminjaman->save();

    return redirect()->back()->with('error', 'Peminjaman telah ditolak.');
  }
}
