<?php

namespace App\Http\Controllers;

use App\Models\Lomba;
use App\Models\KategoriLomba;
use App\Models\PendaftaranLomba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminLombaController extends Controller
{
    public function index()
    {
        $lombas = Lomba::all();
        return view('admin.lomba.AdminDataLomba', compact('lombas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarName = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('admin_lomba'), $gambarName); // Move file directly to public/admin_lomba
            $gambarPath = $gambarName;
        }

        Lomba::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarPath,
        ]);

        return redirect()->back()->with('success', 'Lomba berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        // Temukan lomba berdasarkan ID
        $lomba = Lomba::findOrFail($id);

        // Validasi data
        $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        // Perbarui informasi lomba
        $lomba->judul = $request->input('judul');
        $lomba->deskripsi = $request->input('deskripsi');

        // Tangani pembaruan gambar
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($lomba->gambar && file_exists(public_path('admin_lomba/' . $lomba->gambar))) {
                unlink(public_path('admin_lomba/' . $lomba->gambar));
            }

            // Unggah gambar baru
            $gambar = $request->file('gambar');
            $gambarName = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('admin_lomba'), $gambarName);
            $lomba->gambar = $gambarName;
        }

        // Simpan perubahan
        $lomba->save();

        return redirect()->back()->with('success', 'Lomba berhasil diperbarui');
    }


    public function destroy($id)
    {
        // Cari lomba berdasarkan ID
        $lomba = Lomba::findOrFail($id);

        // Cek apakah lomba memiliki gambar dan file tersebut ada di direktori public
        if ($lomba->gambar && file_exists(public_path('admin_lomba/' . $lomba->gambar))) {
            // Hapus file gambar dari direktori
            unlink(public_path('admin_lomba/' . $lomba->gambar));
        }

        // Hapus data lomba dari database
        $lomba->delete();

        // Cek apakah data berhasil dihapus
        if ($lomba) {
            // Redirect ke halaman sebelumnya dengan pesan sukses
            return back()->with("success", "Data Berhasil Terhapus");
        } else {
            // Redirect ke halaman sebelumnya dengan pesan error
            return back()->with("error", "Data Gagal Terhapus");
        }
    }

    public function showKategori($id)
    {
        // Ambil lomba berdasarkan ID
        $lomba = Lomba::findOrFail($id);

        // Ambil kategori yang berelasi dengan lomba tersebut
        $kategoriLombas = $lomba->kategoriLombas; // Memanfaatkan relasi yang telah dibuat

        // Kirim data lomba dan kategori lomba ke view
        return view('admin.lomba.kategori.KategoriLomba', compact('lomba', 'kategoriLombas'));
    }

    public function viewPeserta($lombaId, $kategoriId)
    {
        $lomba = Lomba::findOrFail($lombaId);
        $kategori = KategoriLomba::findOrFail($kategoriId);

        // Retrieve the participants for the specified category
        $pesertaLombas = PendaftaranLomba::where('lomba_id', $lombaId)
            ->where('kategori_lomba_id', $kategoriId)
            ->get();

        return view('admin.lomba.kategori.peserta.PesertaLomba', compact('lomba', 'kategori', 'pesertaLombas'));
    }
}
