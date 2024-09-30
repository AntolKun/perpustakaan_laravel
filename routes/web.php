<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanController;

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminDataController;
use App\Http\Controllers\AdminBukuController;
use App\Http\Controllers\AdminPeminjamanController;
use App\Http\Controllers\AdminPengembalianController;
use App\Http\Controllers\AdminLombaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//dashboard
Route::get("/dashboard", [DashboardController::class, "index"])
    ->middleware(["auth", "verified"])
    ->name("dashboard");

Route::get('/detailbuku/{id}', [DashboardController::class, 'show'])->name('buku.show');

Route::get('/buku-dipinjam', [DashboardController::class, 'bukuDipinjam'])->name('buku.dipinjam');
Route::get('/buku-dikembalikan', [DashboardController::class, 'bukuDikembalikan'])->name('buku.dikembalikan');

Route::middleware('auth')->group(function () {
    Route::get('peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('peminjaman/create/{buku_id}', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('peminjaman/store', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::get('peminjaman/{id}', [PeminjamanController::class, 'show'])->name('peminjaman.show');

    // Admin routes to approve/reject
    Route::post('peminjaman/approve/{id}', [PeminjamanController::class, 'approve'])->name('peminjaman.approve');
    Route::post('peminjaman/reject/{id}', [PeminjamanController::class, 'reject'])->name('peminjaman.reject');
    Route::get('/adminPengembalian', [AdminPengembalianController::class, 'index'])->name('admin.pengembalian.index');
    Route::post('/adminPengembalian/return/{id}', [AdminPengembalianController::class, 'store'])->name('admin.pengembalian.store');
});





    

// Admin Dashboard
Route::get("/adminDashboard", [AdminDashboardController::class, "index"])
    ->middleware(["auth", "verified"])
    ->name("adminDashboard");

// Data Admin Routes 
Route::get("/adminData", [AdminDataController::class, "index"])
    ->middleware(["auth", "verified"])
    ->name("adminData");
Route::get("/adminLihatData/{id}", [AdminDataController::class, "lihatData"])
    ->middleware(["auth", "verified"])
    ->name("adminLihatData");
Route::get("/adminTambah", [AdminDataController::class, "tambahAdmin"])
    ->middleware(["auth", "verified"])
    ->name("adminTambah");
Route::post("/adminStore", [AdminDataController::class, "store"])
    ->middleware(["auth", "verified"])
    ->name("adminStore");
Route::put("/adminEdit/{id}", [AdminDataController::class, "editData"])
    ->middleware(["auth", "verified"])
    ->name("adminEdit");
Route::get("/getAdminEdit/{id}", [AdminDataController::class, "getDataEdit"])
    ->middleware(["auth", "verified"])
    ->name("getAdminEdit");
Route::delete("/adminDelete/{id}", [AdminDataController::class, "destroy"])
    ->middleware(["auth", "verified"])
    ->name("adminDelete");

//Data Buku Routes
Route::get("/adminBuku", [AdminBukuController::class, "index"])
    ->middleware(["auth", "verified"])
    ->name("adminBuku");
Route::get("/tambahBuku", [AdminBukuController::class, "create"])
    ->middleware(["auth", "verified"])
    ->name("tambahBuku");
Route::post("/storeBuku", [AdminBukuController::class, "store"])
    ->middleware(["auth", "verified"])
    ->name("storeBuku");
Route::delete("/bukuDelete/{id}", [AdminBukuController::class, "destroy"])
    ->middleware(["auth", "verified"])
    ->name("bukuDelete");
Route::get("/adminLihatData/{id}", [AdminDataController::class, "lihatData"])
    ->middleware(["auth", "verified"])
    ->name("adminLihatData");
Route::get("/adminLihatBuku/{id}", [AdminBukuController::class, "show"])
    ->middleware(["auth", "verified"])
    ->name("adminLihatBuku");
Route::get("/getBukuEdit/{id}", [AdminBukuController::class, "edit"])
    ->middleware(["auth", "verified"])
    ->name("getBukuEdit");
Route::put("/BukuEdit/{id}", [AdminBukuController::class, "update"])
    ->middleware(["auth", "verified"])
    ->name("bukuEdit");

// Data Peminjaman Routes
Route::get('/adminPeminjaman', [AdminPeminjamanController::class, 'index'])->middleware(["auth", "verified"])->name('admin.peminjaman');
Route::post('/peminjaman/setujui/{id}', [AdminPeminjamanController::class, 'setujui'])->middleware(["auth", "verified"])->name('admin.peminjaman.setujui');
Route::post('/peminjaman/tolak/{id}', [AdminPeminjamanController::class, 'tolak'])->middleware(["auth", "verified"])->name('admin.peminjaman.tolak');

Route::get('/competitions', [AdminLombaController::class, 'index'])->name('competitions.index');
Route::post('/competitionsSimpan', [AdminLombaController::class, 'store'])->name('competitions.store');
Route::put('/competitions/{id}', [AdminLombaController::class, 'update'])->name('competitions.update');

//login logout
Route::get('/login', [LoginController::class, 'index'])
    ->name('login');
Route::post('actionLogin', [LoginController::class, 'actionLogin']);
Route::get('actionLogout', [LoginController::class, 'actionLogout'])
    ->name('actionLogout')
    ->middleware('auth');

//register
Route::get('/register', [RegisterController::class, 'index'])
    ->name('register');
Route::post('/post-register', [RegisterController::class, 'store']);