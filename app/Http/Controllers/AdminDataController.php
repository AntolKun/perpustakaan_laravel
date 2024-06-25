<?php

namespace App\Http\Controllers;
use App\Models\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminDataController extends Controller
{
    public function index()
    {
        $data["admin"] = Admin::all()->map(function ($admin) {
            $admin->password_placeholder = '********';
            return $admin;
        });
        return view('admin.AdminDataAdmin', $data);
    }

    public function tambahAdmin() {
        return view('admin.AdminTambahAdmin');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::create([
            "nip" => $request->nip,
            "nama" => $request->nama,
            "email" => $request->email,
            "password" => $request->password,
        ]);

        if ($admin) {
            //redirect to index
            return redirect('/adminData')->with("success", "Data Berhasil Tersimpan");
        } else {
            return back()->with("error", "Data Gagal Tersimpan");
        }
    }

    public function destroy($id) {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        if ($admin) {
            //redirect to index
            return back()->with("success", "Data Berhasil Terhapus");
        } else {
            return back()->with("error", "Data Gagal Terhapus");
        }
    }

    public function lihatData($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.AdminLihatData', compact('admin'));
    }

    public function getDataEdit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.AdminEditData', compact('admin'));
    }

    public function editData(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'nip' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $admin->nip = $request->input('nip');
        $admin->nama = $request->input('nama');
        $admin->email = $request->input('email');
        $admin->password = $request->input('password');

        $updated = $admin->save();

        if ($updated) {
            //redirect back
            return redirect('/adminData')->with("success", "Data Berhasil Terupdate");
        } else {
            return back()->with("error", "Data Gagal Terupdate");
        }
    }
}
