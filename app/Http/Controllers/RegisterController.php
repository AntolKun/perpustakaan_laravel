<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
	public function index()
	{
		return view('auth/Register');
	}

	public function store(Request $request)
	{
		$validated = $request->validate([
			'nama' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
			'nisn' => ['required', 'string', 'max:255', 'unique:siswa,nisn'],
			'kelas' => ['required', 'string', 'max:255'],
			'nomor_telepon' => ['required', 'string', 'max:15'],
			'password' => ['required', 'string', 'confirmed', 'min:8'],
		]);

		$user = User::create([
			'email' => $request->email,
			'password' => Hash::make($request->password),
			'role' => 'siswa',
		]);

		Siswa::create([
			'user_id' => $user->id,
			'nama' => $request->nama,
			'nisn' => $request->nisn,
			'kelas' => $request->kelas,
			'nomor_telepon' => $request->nomor_telepon,
			'foto' => $request->foto ?? null,
		]);

		return redirect('/login')->with("success", "Registrasi berhasil, silahkan login.");
	}
}
