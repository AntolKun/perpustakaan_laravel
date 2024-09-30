<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
  // Fungsi untuk menampilkan form peminjaman
  public function create($buku_id)
  {
    $buku = Buku::find($buku_id);
    return view('peminjaman.create', compact('buku'));
  }

  // Fungsi untuk menyimpan data peminjaman baru
  public function store(Request $request)
  {
    $validated = $request->validate([
      'email' => 'required|email',
      'jurusan' => 'required|string|max:255',
      'nisn' => 'required|string|max:255',
      'username' => 'required|string|max:255',
      'nama' => 'required|string|max:255',
      'kelas' => 'required|string|max:255',
      'buku_id' => 'required|exists:bukus,id',
    ]);

    // Kurangi stok buku
    $buku = Buku::findOrFail($request->buku_id);
    if ($buku->stok <= 0) {
      return redirect()->back()->with('error', 'Stok buku habis.');
    }
    $buku->stok -= 1;
    $buku->save();

    // Simpan peminjaman
    Peminjaman::create([
      'buku_id' => $request->buku_id,
      'user_id' => auth()->id(),
      'email' => $request->email,
      'jurusan' => $request->jurusan,
      'nisn' => $request->nisn,
      'username' => $request->username,
      'nama' => $request->nama,
      'kelas' => $request->kelas,
      'status' => 'menunggu persetujuan',
    ]);

    return redirect()->route('dashboard')->with('success', 'Permintaan peminjaman berhasil diajukan.');
  }

  // Fungsi untuk menampilkan daftar peminjaman
  public function index()
  {
    $peminjaman = Peminjaman::where('status', 'menunggu persetujuan')->get();
    return view('admin.peminjaman.index', compact('peminjaman'));
  }

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

  // Fungsi untuk menampilkan detail peminjaman
  public function show($id)
  {
    $peminjaman = Peminjaman::find($id);
    return view('peminjaman.show', compact('peminjaman'));
  }

  // Fungsi untuk admin menyetujui atau menolak peminjaman
  public function approve($id)
  {
    $peminjaman = Peminjaman::find($id);
    $peminjaman->update(['status' => 'disetujui']);
    return redirect()->route('peminjaman.index')->with('success', 'Peminjaman disetujui.');
  }

  public function reject($id)
  {
    $peminjaman = Peminjaman::find($id);
    $peminjaman->update(['status' => 'ditolak']);
    return redirect()->route('peminjaman.index')->with('success', 'Peminjaman ditolak.');
  }
}
