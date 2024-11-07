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
use App\Http\Controllers\AdminNilaiSiswaController;
use App\Http\Controllers\LombaController;
use App\Http\Controllers\PendaftaranLombaController;
use App\Http\Controllers\AdminKategoriBukuController;

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
Route::get('/', function () {
    return redirect('/login');
});

// Admin Routes
Route::middleware(['auth', 'role:admin,pustakawan,juri'])->group(function () {
    Route::get("/adminDashboard", [AdminDashboardController::class, "index"])->name("adminDashboard");
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Route::get("/adminDashboard", [AdminDashboardController::class, "index"])
    //     ->middleware(["auth", "verified"])
    //     ->name("adminDashboard");

    Route::get("/adminData", [AdminDataController::class, "index"])->name("adminData");
    Route::get("/adminLihatData/{id}", [AdminDataController::class, "lihatData"])->name("adminLihatData");
    Route::get("/adminTambah", [AdminDataController::class, "tambahAdmin"])->name("adminTambah");
    Route::post("/adminStore", [AdminDataController::class, "store"])->name("adminStore");
    Route::put("/adminEdit/{id}", [AdminDataController::class, "editData"])->name("adminEdit");
    Route::get("/getAdminEdit/{id}", [AdminDataController::class, "getDataEdit"])->name("getAdminEdit");
    Route::delete('/adminDelete/{id}', [AdminDataController::class, "destroy"])->name('adminDelete');
});

Route::middleware(['auth', 'role:admin,pustakawan'])->group(function () {
    // Route::get("/adminDashboard", [AdminDashboardController::class, "index"])
    // ->middleware(["auth", "verified"])
    // ->name("adminDashboard");

    Route::resource('/adminKategori', AdminKategoriBukuController::class);

    Route::get("/adminBuku", [AdminBukuController::class, "index"])->name("adminBuku");
    Route::get("/tambahBuku", [AdminBukuController::class, "create"])->name("tambahBuku");
    Route::post("/storeBuku", [AdminBukuController::class, "store"])->name("storeBuku");
    Route::delete("/bukuDelete/{id}", [AdminBukuController::class, "destroy"])->name("bukuDelete");
    Route::get("/adminLihatBuku/{id}", [AdminBukuController::class, "show"])->name("adminLihatBuku");
    Route::get("/getBukuEdit/{id}", [AdminBukuController::class, "edit"])->name("getBukuEdit");
    Route::put("/BukuEdit/{id}", [AdminBukuController::class, "update"])->name("bukuEdit");

    Route::get('/adminPeminjaman', [AdminPeminjamanController::class, 'index'])->name('admin.peminjaman');
    Route::post('/peminjaman/setujui/{id}', [AdminPeminjamanController::class, 'setujui'])->name('admin.peminjaman.setujui');
    Route::post('/peminjaman/tolak/{id}', [AdminPeminjamanController::class, 'tolak'])->name('admin.peminjaman.tolak');
    Route::post('peminjaman/approve/{id}', [PeminjamanController::class, 'approve'])->name('peminjaman.approve');
    Route::post('peminjaman/reject/{id}', [PeminjamanController::class, 'reject'])->name('peminjaman.reject');
    Route::get('/adminPengembalian', [AdminPengembalianController::class, 'index'])->name('admin.pengembalian.index');
    Route::post('/adminPengembalian/return/{id}', [AdminPengembalianController::class, 'store'])->name('admin.pengembalian.store');
});

Route::middleware(['auth', 'role:admin,juri'])->group(function () {
    // Route::get("/adminDashboard", [AdminDashboardController::class, "index"])
    // ->middleware(["auth", "verified"])
    // ->name("adminDashboard");

    Route::get('/adminLomba', [AdminLombaController::class, 'index'])->name('lomba.index');
    Route::post('/adminLomba/store', [AdminLombaController::class, 'store'])->name('lomba.store');
    Route::post('/adminLomba/update/{id}', [AdminLombaController::class, 'update'])->name('lomba.update');
    Route::delete('/adminLomba/delete/{id}', [AdminLombaController::class, 'destroy'])->name('lomba.destroy');
    Route::get('/adminLomba/kategori/{id}', [AdminLombaController::class, 'showKategori'])->name('adminLomba.kategori');
    Route::get('/adminLomba/peserta/{id}', [AdminLombaController::class, 'showPeserta'])->name('admin.lomba.peserta');

    Route::post('/adminLomba/kategori/store', [AdminKategoriLombaController::class, 'store'])->name('adminLomba.kategori.store');
    Route::get('/lomba/{lombaId}/kategori-lomba/create', [AdminKategoriLombaController::class, 'create'])->name('adminLomba.kategori.create');
    Route::get('/adminLomba/kategori/edit/{id}', [AdminKategoriLombaController::class, 'edit'])->name('adminLomba.kategori.edit');
    Route::post('/adminLomba/kategori/update/{id}', [AdminKategoriLombaController::class, 'update'])->name('adminLomba.kategori.update');
    Route::delete('/adminLomba/kategori/delete/{id}', [AdminKategoriLombaController::class, 'destroy'])->name('adminLomba.kategori.delete');

    Route::get('/adminPenilaian/{kategoriLombaId}', [AdminPenilaianController::class, 'index'])->name('adminPenilaian.index');
    Route::get('/adminPenilaian/create/{kategoriLombaId}', [AdminPenilaianController::class, 'create'])->name('adminPenilaian.create');
    Route::post('/adminPenilaian/store/{kategoriLombaId}', [AdminPenilaianController::class, 'store'])->name('adminPenilaian.store');
    Route::get('/adminPenilaian/edit/{id}', [AdminPenilaianController::class, 'edit'])->name('adminPenilaian.edit');
    Route::post('/adminPenilaian/update/{id}', [AdminPenilaianController::class, 'update'])->name('adminPenilaian.update');
    Route::delete('/adminPenilaian/delete/{id}', [AdminPenilaianController::class, 'destroy'])->name('adminPenilaian.delete');

    Route::get('/adminLomba/{lomba}/kategori/{kategori}/peserta', [AdminLombaController::class, 'viewPeserta'])->name('adminLomba.kategori.peserta');
    Route::get('/nilai-siswa/{pendaftaran_id}/{kategori_lomba_id}', [AdminNilaiSiswaController::class, 'show'])->name('nilai-siswa.show');
    Route::post('/nilai-siswa', [AdminNilaiSiswaController::class, 'store'])->name('nilai-siswa.store');
});


// User Routes
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get("/dashboard", [DashboardController::class, "index"])
    ->middleware(["auth", "verified"])
    ->name("dashboard");
    Route::put('/siswa/{id}', [DashboardController::class, 'editSiswaData'])->name('siswa.update');

    Route::get('/detailbuku/{id}', [DashboardController::class, 'show'])->middleware(["auth", "verified"])->name('buku.show');

    Route::get('/buku-dipinjam', [DashboardController::class, 'bukuDipinjam'])->middleware(["auth", "verified"])->name('buku.dipinjam');
    Route::get('/buku-dikembalikan', [DashboardController::class, 'bukuDikembalikan'])->middleware(["auth", "verified"])->name('buku.dikembalikan');

    Route::get('peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('peminjaman/create/{buku_id}', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('peminjaman/store', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::get('peminjaman/{id}', [PeminjamanController::class, 'show'])->name('peminjaman.show');

    Route::get('/lomba', [LombaController::class, 'index'])->name('user.lomba');
    Route::get('/lomba/{id}', [LombaController::class, 'detail'])->name('lomba.detail');
    Route::post('/lomba/{id}/daftar', [PendaftaranLombaController::class, 'store'])->name('lomba.daftar.store');
    Route::get('/lomba/{id}/peserta', [LombaController::class, 'showPeserta'])->name('lomba.peserta');
    Route::get('/lomba/{id}/pemenang', [LombaController::class, 'pengumumanPemenang'])->name('lomba.pemenang');
});


//login logout
Route::get('/login', function () {
    return view('auth.Login');
})->name('login');
Route::post('actionLogin', [LoginController::class, 'actionLogin']);
Route::get('actionLogout', [LoginController::class, 'actionLogout'])
    ->name('actionLogout')
    ->middleware('auth');

//register
Route::get('/register', [RegisterController::class, 'index'])
    ->name('register');
Route::post('/post-register', [RegisterController::class, 'store']);