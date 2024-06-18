<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
		public function index() {
			return view ('auth/Register');
		}

		public function store(Request $request)
		{
				$validated = $request->validate([
						'username' => ['required', 'string', 'max:255'],
						'email' => ['required', 'string', 'email', 'max:255'],
						'nisn' => ['required', 'string', 'max:255', 'unique:users'],
						'kelas' => ['required', 'string', 'max:255'],
						'password' => ['required', 'string', 'min:8', 'confirmed'],
				]);

				$user = User::create([
						"username" => $request->username,
						"email" => $request->email,
						"nisn" => $request->nisn,
						"kelas" => $request->kelas,
						"password" => $request->password,
				]);

				if ($user) {
						//redirect to index
						return redirect('/login')->with("success", "Data Berhasil Tersimpan");
				} else {
						return back()->with("error", "Data Gagal Tersimpan");
				}
		}
}

