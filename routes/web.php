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
use App\Http\Controllers\AdminKategoriLombaController;
use App\Http\Controllers\AdminPenilaianController;
use App\Http\Controllers\LombaController;

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

Route::get('/detailbuku/{id}', [DashboardController::class, 'show'])->middleware(["auth", "verified"])->name('buku.show');

Route::get('/buku-dipinjam', [DashboardController::class, 'bukuDipinjam'])->middleware(["auth", "verified"])->name('buku.dipinjam');
Route::get('/buku-dikembalikan', [DashboardController::class, 'bukuDikembalikan'])->middleware(["auth", "verified"])->name('buku.dikembalikan');

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

    Route::get('/lomba', [LombaController::class, 'index'])->name('user.lomba');
    Route::get('/lomba/{id}', [LombaController::class, 'detail'])->name('lomba.detail');
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

// Data Lomba Routes
Route::get('/adminLomba', [AdminLombaController::class, 'index'])->middleware(["auth", "verified"])->name('lomba.index');
Route::post('/adminLomba/store', [AdminLombaController::class, 'store'])->middleware(["auth", "verified"])->name('lomba.store');
Route::post('/adminLomba/update/{id}', [AdminLombaController::class, 'update'])->middleware(["auth", "verified"])->name('lomba.update');
Route::delete('/adminLomba/delete/{id}', [AdminLombaController::class, 'destroy'])->middleware(["auth", "verified"])->name('lomba.destroy');
Route::get('/adminLomba/kategori/{id}', [AdminLombaController::class, 'showKategori'])->name('adminLomba.kategori');

// Kategori Lomba Routes
Route::post('/adminLomba/kategori/store', [AdminKategoriLombaController::class, 'store'])->middleware(["auth", "verified"])->name('adminLomba.kategori.store');
Route::get('/lomba/{lombaId}/kategori-lomba/create', [AdminKategoriLombaController::class, 'create'])->middleware(["auth", "verified"])->name('adminLomba.kategori.create');
Route::get('/adminLomba/kategori/edit/{id}', [AdminKategoriLombaController::class, 'edit'])->middleware(["auth", "verified"])->name('adminLomba.kategori.edit');
Route::post('/adminLomba/kategori/update/{id}', [AdminKategoriLombaController::class, 'update'])->middleware(["auth", "verified"])->name('adminLomba.kategori.update');
Route::delete('/adminLomba/kategori/delete/{id}', [AdminKategoriLombaController::class, 'destroy'])->middleware(["auth", "verified"])->name('adminLomba.kategori.delete');

// Penilaian Lomba Routes
Route::get('/adminPenilaian/{kategoriLombaId}', [AdminPenilaianController::class, 'index'])->name('adminPenilaian.index');
Route::get('/adminPenilaian/create/{kategoriLombaId}', [AdminPenilaianController::class, 'create'])->name('adminPenilaian.create');
Route::post('/adminPenilaian/store/{kategoriLombaId}', [AdminPenilaianController::class, 'store'])->name('adminPenilaian.store');
Route::get('/adminPenilaian/edit/{id}', [AdminPenilaianController::class, 'edit'])->name('adminPenilaian.edit');
Route::post('/adminPenilaian/update/{id}', [AdminPenilaianController::class, 'update'])->name('adminPenilaian.update');
Route::delete('/adminPenilaian/delete/{id}', [AdminPenilaianController::class, 'destroy'])->name('adminPenilaian.delete');






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