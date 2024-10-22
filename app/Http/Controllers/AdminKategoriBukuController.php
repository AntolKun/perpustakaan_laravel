<?php

namespace App\Http\Controllers;

use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class AdminKategoriBukuController extends Controller
{
  public function index()
  {
    $kategoris = KategoriBuku::all();
    return view('admin.kategori.AdminDataKategori', compact('kategoris'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'nama_kategori' => 'required|string|max:255',
    ]);

    KategoriBuku::create([
      'nama_kategori' => $request->input('nama_kategori'),
    ]);

    return redirect('/adminKategori')->with('success', 'Kategori berhasil ditambahkan');
  }

  public function update(Request $request, $id)
  {
    $kategori = KategoriBuku::findOrFail($id);

    $request->validate([
      'nama_kategori' => 'required|string|max:255',
    ]);

    $kategori->update([
      'nama_kategori' => $request->input('nama_kategori'),
    ]);

    return redirect('/adminKategori')->with('success', 'Kategori berhasil diperbarui');
  }

  public function destroy($id)
  {
    $kategori = KategoriBuku::findOrFail($id);
    $kategori->delete();

    return redirect('/adminKategori')->with('success', 'Kategori berhasil dihapus');
  }
}
