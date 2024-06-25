<?php

namespace App\Http\Controllers;

use App\Models\Buku;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminBukuController extends Controller
{
    public function index()
    {
        $data["buku"] = Buku::get();
        return view('admin.buku.AdminDataBuku', $data);
    }

    public function tambahBuku()
    {
        return view('admin.buku.AdminTambahBuku');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judulbuku' => 'required',
            'isbn' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'stok' => 'required',
            'sinopsis' => 'required',
            'gambar' => 'required',
        ]);

        //upload image
        $buku = $request->file('gambar');
        // upload file
        $buku->move('fotobuku', $buku->getClientOriginalName());

        $buku = Buku::create([
            "gambar" => $buku->getClientOriginalName(),
            "judulbuku" => $request->judulbuku,
            "isbn" => $request->isbn,
            "penerbit" => $request->penerbit,
            "tahun_terbit" => $request->tahun_terbit,
            "stok" => $request->stok,
            "sinopsis" => $request->sinopsis,
        ]);

        if ($buku) {
            //redirect to index
            return redirect('/adminBuku')->with("success", "Data Berhasil Tersimpan");
        } else {
            return back()->with("error", "Data Gagal Tersimpan");
        }
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        // Get the image file name
        $imagePath = public_path('fotobuku/' . $buku->gambar);

        // Delete the image file if it exists
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $buku->delete();

        if ($buku) {
            //redirect to index
            return back()->with("success", "Data Berhasil Terhapus");
        } else {
            return back()->with("error", "Data Gagal Terhapus");
        }
    }

    public function lihatBuku($id)
    {
        $buku = Buku::findOrFail($id);
        return view('admin.buku.AdminLihatBuku', compact('buku'));
    }

    public function getBukuEdit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('admin.buku.AdminEditBuku', compact('buku'));
    }

    public function editBuku(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $request->validate([
            'nip' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $buku->nip = $request->input('nip');
        $buku->nama = $request->input('nama');
        $buku->email = $request->input('email');
        $buku->password = $request->input('password');

        $updated = $buku->save();

        if ($updated) {
            //redirect back
            return redirect('/adminData')->with("success", "Data Berhasil Terupdate");
        } else {
            return back()->with("error", "Data Gagal Terupdate");
        }
    }
}
