<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminDataController extends Controller
{
    public function index()
    {
        $admin = Admin::with('user')->get();
        return view('admin.AdminDataAdmin', compact('admin'));
    }

    public function tambahAdmin()
    {
        return view('admin.AdminTambahAdmin');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:Admin,Pustakawan,Juri',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('admin_photos'), $fotoName);
            $fotoPath = $fotoName;
        }

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, 
        ]);

        Admin::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('adminData')->with('success', 'Admin berhasil ditambahkan.');
    }

    public function lihatData($id)
    {
        $admin = Admin::with('user')->findOrFail($id);
        return view('admin.AdminLihatData', compact('admin'));
    }

    public function getDataEdit($id)
    {
        $admin = Admin::with('user')->findOrFail($id);
        return view('admin.AdminEditData', compact('admin'));
    }

    public function editData(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $user = User::findOrFail($admin->user_id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Handle foto
        $fotoPath = $admin->foto;
        if ($request->hasFile('foto')) {
            if ($fotoPath && file_exists(public_path('admin_photos/' . $fotoPath))) {
                unlink(public_path('admin_photos/' . $fotoPath));
            }

            $foto = $request->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('admin_photos'), $fotoName);
            $fotoPath = $fotoName;
        }

        // Update user data
        $user->update([
            'email' => $request->email,
            'role' => $request->role,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        // Update admin data
        $admin->update([
            'nama' => $request->nama,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('adminData')->with('success', 'Admin berhasil diupdate.');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $user = User::findOrFail($admin->user_id);

        if ($admin->foto && file_exists(public_path('admin_photos/' . $admin->foto))) {
            unlink(public_path('admin_photos/' . $admin->foto)); // Ensure the correct path is used
        }

        $admin->delete();
        $user->delete();

        if ($admin) {
            //redirect to index
            return back()->with("success", "Data Berhasil Terhapus");
        } else {
            return back()->with("error", "Data Gagal Terhapus");
        }
    }
}
