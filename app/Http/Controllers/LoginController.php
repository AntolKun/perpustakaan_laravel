<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class LoginController extends Controller
{
	public function index()
	{
		if (Auth::check()) {
			return redirect('/dashboard');
		} else {
			return view('auth/Login');
		}
	}

	public function actionLogin(Request $request)
	{
		$data = [
			'username' => $request->username,
			'password' => $request->password,
		];

		if (Auth::attempt($data)) {
			return redirect('/dashboard')->with('success', 'Berhasil Login!');
			// return back()->with('success', 'Masuk');
		} else {
			return back()->with('error', 'Nama atau Password salah!');
		}
	}

	public function actionLogout()
	{
		Auth::logout();
		request()->session()->invalidate();
		request()->session()->regenerateToken();
		return redirect('/login');
	}
}
