<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\KategoriLomba;
use Illuminate\Http\Request;

class AdminPenilaianController extends Controller
{
    public function index($kategoriLombaId)
    {
        $kategoriLomba = KategoriLomba::findOrFail($kategoriLombaId);

        $penilaians = Penilaian::where('kategori_lomba_id', $kategoriLombaId)->get();

        return view('admin.lomba.kategori.penilaian.DataPenilaian', compact('kategoriLomba', 'penilaians'));
    }
    public function create($kategoriLombaId)
    {
        $kategoriLomba = KategoriLomba::findOrFail($kategoriLombaId);
        return view('admin.penilaian.create', compact('kategoriLomba'));
    }
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
    public function edit($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        return view('admin.penilaian.edit', compact('penilaian'));
    }
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
