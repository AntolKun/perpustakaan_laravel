<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Admin;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Lomba;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $countAdmin = Admin::count();
        $countBuku = Buku::count();
        $countPeminjaman = Peminjaman::count();
        $countPengembalian = Pengembalian::count();
        $countLomba = Lomba::count();
        return view('admin.AdminDashboard', compact('countAdmin', 'countBuku', 'countPeminjaman', 'countPengembalian', 'countLomba'));
    }
}
