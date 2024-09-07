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

    public function tambahAdmin()
    {
        return view('admin.AdminTambahAdmin');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('admin_photos'), $fotoName); // Move file directly to public/admin_photos
            $fotoPath = $fotoName;
        }

        $admin = Admin::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'foto' => $fotoPath,
        ]);

        if ($admin) {
            return redirect('/adminData')->with("success", "Data Berhasil Tersimpan");
        } else {
            return back()->with("error", "Data Gagal Tersimpan");
        }
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);

        if ($admin->foto && file_exists(public_path('storage/' . $admin->foto))) {
            unlink(public_path('storage/' . $admin->foto));
        }

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
            'nama' => 'required',
            'username' => 'required|unique:admins,username,' . $id,
            'email' => 'required|email|unique:admins,email,' . $id,
            'password' => 'nullable|string|confirmed|min:8',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $admin->nama = $request->input('nama');
        $admin->username = $request->input('username');
        $admin->email = $request->input('email');

        // Only update password if it is provided
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->input('password'));
        }

        // Handle photo update
        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($admin->foto && file_exists(public_path('admin_photos/' . $admin->foto))) {
                unlink(public_path('admin_photos/' . $admin->foto));
            }

            // Upload new photo
            $foto = $request->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('admin_photos'), $fotoName);
            $admin->foto = $fotoName;
        }

        $updated = $admin->save();

        if ($updated) {
            return redirect('/adminData')->with("success", "Data Berhasil Terupdate");
        } else {
            return back()->with("error", "Data Gagal Terupdate");
        }
    }
}
