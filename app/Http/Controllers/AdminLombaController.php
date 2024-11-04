<?php

namespace App\Http\Controllers;

use App\Models\Lomba;
use App\Models\Penilaian;
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

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'judul' => 'required',
    //         'deskripsi' => 'required',
    //         'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
    //     ]);

    //     $gambarPath = null;
    //     if ($request->hasFile('gambar')) {
    //         $gambar = $request->file('gambar');
    //         $gambarName = time() . '_' . $gambar->getClientOriginalName();
    //         $gambar->move(public_path('admin_lomba'), $gambarName); // Move file directly to public/admin_lomba
    //         $gambarPath = $gambarName;
    //     }

    //     Lomba::create([
    //         'judul' => $request->judul,
    //         'deskripsi' => $request->deskripsi,
    //         'gambar' => $gambarPath,
    //     ]);

    //     return redirect()->back()->with('success', 'Lomba berhasil ditambahkan');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        // Handle image upload
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarName = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('admin_lomba'), $gambarName);
            $gambarPath = $gambarName;
        }

        // Create the lomba
        $lomba = Lomba::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarPath,
        ]);

        // Define categories and penilaian data
        $categories = [
            [
                'nama_kategori' => 'Story Telling',
                'penilaians' => [
                    'field_1' => 'Isi cerita',
                    'field_2' => 'Ekspresi',
                    'field_3' => 'Gestur Tubuh',
                    'field_4' => 'Pengucapan bahasa inggris',
                ],
            ],
            [
                'nama_kategori' => 'Baca Puisi',
                'penilaians' => [
                    'field_1' => 'Ekspresi',
                    'field_2' => 'Artikulasi dan diksi',
                    'field_3' => 'Gestur',
                    'field_4' => 'Pemahaman isi puisi',
                ],
            ],
            [
                'nama_kategori' => 'Poster',
                'penilaians' => [
                    'field_1' => 'Kreativitas',
                    'field_2' => 'Kerapihan/tata letak/komposisi',
                    'field_3' => 'Ketepatan tema',
                    'field_4' => 'Pemilihan warna',
                ],
            ],
        ];

        // Loop through each category and create it along with its penilaian
        foreach ($categories as $categoryData) {
            // Create KategoriLomba
            $kategori = KategoriLomba::create([
                'nama_kategori' => $categoryData['nama_kategori'],
                'lomba_id' => $lomba->id,
            ]);

            // Create Penilaian for each kategori
            Penilaian::create([
                'kategori_lomba_id' => $kategori->id,
                'field_1' => $categoryData['penilaians']['field_1'],
                'field_2' => $categoryData['penilaians']['field_2'],
                'field_3' => $categoryData['penilaians']['field_3'],
                'field_4' => $categoryData['penilaians']['field_4'],
            ]);
        }

        return redirect()->back()->with('success', 'Lomba berhasil ditambahkan dengan kategori dan penilaian');
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

        // Retrieve the participants along with their grades (nilai siswa)
        $pesertaLombas = PendaftaranLomba::where('lomba_id', $lombaId)
            ->where('kategori_lomba_id', $kategoriId)
            ->with('nilaiSiswa') // Load nilaiSiswa relationship
            ->get();

        return view('admin.lomba.kategori.peserta.PesertaLomba', compact('lomba', 'kategori', 'pesertaLombas'));
    }

}
