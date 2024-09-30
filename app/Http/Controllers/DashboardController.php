<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Buku;

class DashboardController extends Controller
{
		public function index() {

			$buku = Buku::all();
			return view('Dashboard', ['buku' => $buku]);
		}

	public function show($id)
	{
		$buku = Buku::findOrFail($id);
		return view('DetailBuku', compact('buku'));
	}

	public function bukuDipinjam()
	{
		$userId = Auth::id();
		// $peminjaman = Peminjaman::where('user_id', $userId)->where('status', 'disetujui')->get();
		$peminjaman = Peminjaman::where('user_id', $userId)->get();
		return view('Peminjaman', ['peminjaman' => $peminjaman]);
	}

	public function bukuDikembalikan()
	{
		$userId = Auth::id(); // Mendapatkan ID user yang sedang login

		// Ambil data peminjaman yang belum memiliki entri di tabel pengembalian (belum dikembalikan)
		$belumDikembalikan = Peminjaman::with('buku')
		->where('user_id', $userId)
			->whereDoesntHave('pengembalian') // Belum dikembalikan
			->where('status', 'disetujui')    // Status disetujui
			->get();

		// Ambil data pengembalian (sudah dikembalikan)
		$sudahDikembalikan = Pengembalian::with('peminjaman.buku')
		->whereHas('peminjaman', function ($query) use ($userId) {
			$query->where('user_id', $userId);
		})->get();

		$dataPeminjaman = $belumDikembalikan->concat($sudahDikembalikan);

		return view('Pengembalian', ['dataPeminjaman' => $dataPeminjaman]);
	}
}

