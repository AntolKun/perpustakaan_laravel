<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\KategoriLomba;
use Illuminate\Http\Request;

class AdminPenilaianController extends Controller
{
    public function create($kategoriLombaId)
    {
        $kategoriLomba = KategoriLomba::findOrFail($kategoriLombaId);
        return view('admin.penilaian.create', compact('kategoriLomba'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'field_1' => 'required|string',
            'field_2' => 'required|string',
            'field_3' => 'required|string',
            'field_4' => 'required|string',
        ]);

        Penilaian::create([
            'kategori_lomba_id' => $request->kategori_lomba_id,
            'field_1' => $request->field_1,
            'field_2' => $request->field_2,
            'field_3' => $request->field_3,
            'field_4' => $request->field_4,
        ]);

        return redirect()->back()->with('success', 'Penilaian berhasil ditambahkan');
    }
}

