<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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

	public function editSiswaData(Request $request, $id)
	{
		// Find siswa and associated user data
		$siswa = Siswa::findOrFail($id);
		$user = User::findOrFail($siswa->user_id);

		// Validate the request
		$request->validate([
			'nama' => 'required|string',
			'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif',
			'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
			'password' => 'nullable|string|min:8|confirmed',
			'nisn' => 'required|string',
			'kelas' => 'required|string',
			'nomor_telepon' => 'required|string',
		]);

		// Handle foto
		$fotoPath = $siswa->foto;
		if ($request->hasFile('foto')) {
			// Delete the old photo if it exists
			if ($fotoPath && file_exists(public_path('siswa_photos/' . $fotoPath))) {
				unlink(public_path('siswa_photos/' . $fotoPath));
			}

			// Save new photo
			$foto = $request->file('foto');
			$fotoName = time() . '_' . $foto->getClientOriginalName();
			$foto->move(public_path('siswa_photos'), $fotoName);
			$fotoPath = $fotoName;
		}

		// Update user data
		$user->update([
			'email' => $request->email,
			'password' => $request->password ? Hash::make($request->password) : $user->password,
		]);

		// Update siswa data
		$siswa->update([
			'nama' => $request->nama,
			'nisn' => $request->nisn,
			'kelas' => $request->kelas,
			'nomor_telepon' => $request->nomor_telepon,
			'foto' => $fotoPath,
		]);

		return redirect()->back()->with('success', 'Data siswa berhasil diupdate.');		
	}
}

