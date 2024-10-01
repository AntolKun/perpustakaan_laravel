<?php

namespace App\Http\Controllers;

use App\Models\KategoriLomba;
use Illuminate\Http\Request;

class AdminKategoriLombaController extends Controller
{
    // Store a new KategoriLomba
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string',
            'lomba_id' => 'required|exists:lombas,id', // Ensure lomba exists
        ]);

        KategoriLomba::create([
            'nama_kategori' => $request->input('nama_kategori'),
            'lomba_id' => $request->input('lomba_id'),
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan');
    }

    // Update an existing KategoriLomba
    public function update(Request $request, $id)
    {
        $kategoriLomba = KategoriLomba::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string',
        ]);

        $kategoriLomba->nama_kategori = $request->input('nama_kategori');
        $kategoriLomba->save();

        return redirect()->back()->with('success', 'Kategori berhasil diperbarui');
    }

    // Delete a KategoriLomba
    public function destroy($id)
    {
        $kategoriLomba = KategoriLomba::findOrFail($id);
        $kategoriLomba->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }
}
