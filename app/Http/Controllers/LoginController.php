<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
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

	public function loginAdmin()
	{
		if (Auth::check()) {
			return redirect('/adminDashboard');
		} else {
			return view('auth/AdminLogin');
		}
	}

	public function actionLogin(Request $request)
	{
		$data = [
			'email' => $request->email,
			'password' => $request->password,
		];

		if (Auth::attempt($data)) {
			return redirect('/dashboard')->with('success', 'Berhasil Login!');
		} else {
			return back()->with('error', 'Email atau Password salah!');
		}
	}

	public function actionAdminLogin(Request $request)
	{
		$request->validate([
			'email' => 'required|email',
			'password' => 'required',
		]);

		$credentials = $request->only('email', 'password');

		if (Auth::guard('admin')->attempt($credentials)) {
			return redirect()->route('adminDashboard')->with('success', 'Berhasil Login sebagai Admin!');
		} else {
			return back()->with('error', 'Email atau Password Admin salah!');
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
