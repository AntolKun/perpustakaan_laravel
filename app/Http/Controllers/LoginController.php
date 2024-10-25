<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
	public function actionLogin(Request $request)
	{
		$request->validate([
			'email' => 'required|email',
			'password' => 'required|string',
		]);

		$credentials = $request->only('email', 'password');

		if (Auth::attempt($credentials)) {
			$user = Auth::user();
			switch ($user->role) {
				case 'admin':
					return redirect()->route('adminDashboard')->with("success", "Berhasil Login Sebagai Admin!");
				case 'siswa':
					return redirect()->route('dashboard')->with("success", "Berhasil Login!");
			}
		}

		return back()->withErrors([
			'email' => 'Email atau password salah.',
		]);
	}

	public function actionLogout()
	{
		Auth::logout();
		return redirect('/login')->with("success", "Berhasil Logout!");
	}
}
