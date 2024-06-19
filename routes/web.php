<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminDataController;

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

Route::get("/adminDashboard", [AdminDashboardController::class, "index"])
    ->middleware(["auth", "verified"])
    ->name("adminDashboard");

Route::get("/adminData", [AdminDataController::class, "index"])
    ->middleware(["auth", "verified"])
    ->name("adminData");

//login logout
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('actionLogin', [LoginController::class, 'actionLogin']);
Route::get('actionLogout', [LoginController::class, 'actionLogout'])->name('actionLogout')->middleware('auth');

//register
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/post-register', [RegisterController::class, 'store']);