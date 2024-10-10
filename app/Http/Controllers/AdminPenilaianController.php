<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\KategoriLomba;
use Illuminate\Http\Request;

class AdminPenilaianController extends Controller
{
    /**
     * Menampilkan daftar penilaian untuk kategori lomba tertentu.
     */
    public function index($kategoriLombaId)
    {
        // Ambil data kategori lomba berdasarkan ID
        $kategoriLomba = KategoriLomba::findOrFail($kategoriLombaId);

        // Ambil data penilaian yang berhubungan dengan kategori lomba tersebut
        $penilaians = Penilaian::where('kategori_lomba_id', $kategoriLombaId)->get();

        // Kirim data ke view
        return view('admin.lomba.kategori.penilaian.DataPenilaian', compact('kategoriLomba', 'penilaians'));
    }

    /**
     * Menampilkan form untuk membuat penilaian baru.
     */
    public function create($kategoriLombaId)
    {
        $kategoriLomba = KategoriLomba::findOrFail($kategoriLombaId);
        return view('admin.penilaian.create', compact('kategoriLomba'));
    }

    /**
     * Menyimpan data penilaian baru ke database.
     */
    public function store(Request $request, $kategoriLombaId)
    {
        // Cek apakah kategori lomba sudah memiliki penilaian
        $existingPenilaian = Penilaian::where('kategori_lomba_id', $kategoriLombaId)->first();

        if ($existingPenilaian) {
            return redirect()->back()->with('error', 'Kategori lomba ini sudah memiliki penilaian.');
        }

        // Validasi data input
        $request->validate([
            'field_1' => 'required',
            'field_2' => 'required',
            'field_3' => 'required',
            'field_4' => 'required',
        ]);

        // Simpan penilaian baru
        Penilaian::create([
            'kategori_lomba_id' => $kategoriLombaId,
            'field_1' => $request->field_1,
            'field_2' => $request->field_2,
            'field_3' => $request->field_3,
            'field_4' => $request->field_4,
        ]);

        return redirect()->route('adminPenilaian.index', $kategoriLombaId)
            ->with('success', 'Penilaian berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit penilaian.
     */
    public function edit($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        return view('admin.penilaian.edit', compact('penilaian'));
    }

    /**
     * Memperbarui data penilaian di database.
     */
    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'field_1' => 'required',
            'field_2' => 'required',
            'field_3' => 'required',
            'field_4' => 'required',
        ]);

        // Temukan data penilaian berdasarkan ID
        $penilaian = Penilaian::findOrFail($id);

        // Perbarui data penilaian
        $penilaian->update($request->all());

        return redirect()->route('adminPenilaian.index', $penilaian->kategori_lomba_id)
            ->with('success', 'Penilaian berhasil diperbarui.');
    }

    /**
     * Menghapus penilaian dari database.
     */
    public function destroy($id)
    {
        // Temukan penilaian berdasarkan ID dan hapus
        $penilaian = Penilaian::findOrFail($id);
        $kategoriLombaId = $penilaian->kategori_lomba_id;
        $penilaian->delete();

        return redirect()->route('adminPenilaian.index', $kategoriLombaId)
            ->with('success', 'Penilaian berhasil dihapus.');
    }
}
