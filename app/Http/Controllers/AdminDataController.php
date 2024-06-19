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
        return view('admin.AdminDataAdmin');
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
            "nip" => $request->name,
            "nama" => $request->email,
            "email" => $request->role,
            "password" => $request->password,
        ]);

        if ($admin) {
            //redirect to index
            return back()->with("success", "Data Berhasil Tersimpan");
        } else {
            return back()->with("error", "Data Gagal Tersimpan");
        }
    }
}
