<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class AdminBukuController extends Controller
{
    // Display all books
    public function index()
    {
        // $bukus = Buku::all();
        $data["buku"] = Buku::with('kategori')->get();
        return view('admin.buku.AdminDataBuku', $data);
    }

    // Show the form for creating a new book
    public function create()
    {
        $data['kategori'] = KategoriBuku::all(); // Load all categories
        return view('admin.buku.AdminTambahBuku', $data);
    }

    // Store a new book
    public function store(Request $request)
    {
        $request->validate([
            'judulbuku' => 'required',
            'isbn' => 'required|unique:bukus',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|integer',
            'stok' => 'required|integer',
            'penulis' => 'required',
            'halaman' => 'required|integer',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif',
            'kategori_id' => 'nullable|exists:kategori_buku,id',
        ]);

        // Upload image
        $fotoPath = null;
        if ($request->hasFile('gambar')) {
            $foto = $request->file('gambar');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('buku_photos'), $fotoName); // Move file directly to public/admin_photos
            $fotoPath = $fotoName;
        }

        // Create book
        Buku::create([
            'judulbuku' => $request->input('judulbuku'),
            'isbn' => $request->input('isbn'),
            'penerbit' => $request->input('penerbit'),
            'tahun_terbit' => $request->input('tahun_terbit'),
            'stok' => $request->input('stok'),
            'penulis' => $request->input('penulis'),
            'halaman' => $request->input('halaman'),
            'deskripsi' => $request->input('deskripsi'),
            'gambar' => $fotoPath,
            'kategori_id' => $request->input('kategori_id'),
        ]);

        return redirect('/adminBuku')->with('success', 'Buku berhasil ditambahkan');
    }

    // Show a specific book
    public function show($id)
    {
        $buku = Buku::findOrFail($id);
        return view('admin.buku.AdminLihatBuku', compact('buku'));
    }

    // Show the form to edit an existing book
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $data['kategori'] = KategoriBuku::all();
        return view('admin.buku.AdminEditBuku', ('buku, data'));
    }

    // Update an existing book
    public function update(Request $request, $id)
    {
        // Temukan buku berdasarkan ID
        $buku = Buku::findOrFail($id);

        // Validasi data
        $request->validate([
            'judulbuku' => 'required|string',
            'isbn' => 'required|unique:bukus,isbn,' . $buku->id,
            'penerbit' => 'required|string',
            'tahun_terbit' => 'required|integer',
            'stok' => 'required|integer',
            'penulis' => 'required|string',
            'halaman' => 'required|integer',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kategori_id' => 'nullable|exists:kategori_buku,id',
        ]);

        // Perbarui informasi buku
        $buku->judulbuku = $request->input('judulbuku');
        $buku->isbn = $request->input('isbn');
        $buku->penerbit = $request->input('penerbit');
        $buku->tahun_terbit = $request->input('tahun_terbit');
        $buku->stok = $request->input('stok');
        $buku->penulis = $request->input('penulis');
        $buku->halaman = $request->input('halaman');
        $buku->deskripsi = $request->input('deskripsi');
        $buku->kategori_id = $request->input('kategori_id');

        // Tangani pembaruan gambar
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($buku->gambar && file_exists(public_path('buku_photos/' . $buku->gambar))) {
                unlink(public_path('buku_photos/' . $buku->gambar));
            }

            // Unggah gambar baru
            $gambar = $request->file('gambar');
            $gambarName = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('buku_photos'), $gambarName);
            $buku->gambar = $gambarName;
        }

        // Simpan perubahan
        $buku->save();

        return redirect('/adminBuku')->with('success', 'Buku berhasil diperbarui');
    }

    // Delete a book
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        return redirect('/adminBuku')->with('success', 'Buku berhasil ditambahkan');
    }
}
