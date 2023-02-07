<?php

use App\Http\Controllers\Masyarakat\LoginController;
use App\Http\Controllers\Masyarakat\PengaduanController;
use App\Http\Controllers\Masyarakat\RegisterController;
use App\Http\Controllers\Masyarakat\TanggapanController as MasyarakatTanggapanController;
use App\Http\Controllers\Petugas\LaporanController;
use App\Http\Controllers\Petugas\LoginController as PetugasLoginController;
use App\Http\Controllers\Petugas\RegisterController as PetugasRegisterController;
use App\Http\Controllers\Petugas\TanggapanController;
use App\Http\Controllers\Petugas\ValidasiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// VIEW SECTION MASYARAKAT
Route::get('/login', [LoginController::class, 'index'])->name("login")->middleware("guest");
Route::get('/register', [RegisterController::class, 'index'])->name("register")->middleware("guest");
Route::get('/pengaduan/{id?}', [PengaduanController::class, 'index'])->name("pengaduan")->middleware("auth:msy");
Route::get('/tanggapan-pengaduan/{id}', [MasyarakatTanggapanController::class, 'index'])->name("tanggapan")->middleware("auth:msy");
// END VIEW SECTION MASYARAKAT

// VIEW SECTION PETUGAS
Route::get('/staff/login', [PetugasLoginController::class, 'index'])->middleware("guest");
Route::get('/staff/validasi', [ValidasiController::class, 'index'])->middleware("auth:petugas");
Route::get('/staff/tanggapan/{id?}', [TanggapanController::class, 'index'])->name("tanggapan-petugas")->middleware("auth:petugas");
Route::get('/staff/laporan', [LaporanController::class, 'index'])->name("generate-laporan")->middleware(["auth:petugas"]);
Route::get('/staff/register/{id?}', [PetugasRegisterController::class, 'index'])->name("register-petugas")->middleware(["auth:petugas", "admin"]);
// END VIEW SECTION PETUGAS


// ADD SECTION MASYARAKAT
Route::post('/login', [LoginController::class, 'post'])->name("post-login")->middleware("guest");
Route::post('/register', [RegisterController::class, 'post'])->name("post-register")->middleware("guest");
Route::post('/pengaduan', [PengaduanController::class, 'post'])->name("post-pengaduan")->middleware("auth:msy");
// END ADD SECTION MASYARAKAT

// ADD SECTIO PTUGAS
Route::post('/staff/login', [PetugasLoginController::class, 'post'])->name("post-login-admin")->middleware("guest");
Route::post('/staff/validasi', [ValidasiController::class, 'post'])->name("post-validasi")->middleware("auth:petugas");
Route::post('/staff/tanggapan', [TanggapanController::class, 'post'])->name("post-tanggapan-admin")->middleware("auth:petugas");
Route::post('/staff/register', [PetugasRegisterController::class, 'post'])->name("post-register-petugas")->middleware(["auth:petugas", "admin"]);
Route::get('/laporan', [LaporanController::class, 'post'])->name("export-laporan");
// END ADD SECTIO PTUGAS

Route::delete('/pengaduan/{id}', [PengaduanController::class, "destroy"])->name("destroy-pengaduan");
Route::delete('/logout', [LoginController::class, 'delete'])->name("logout-masyarakat")->middleware("auth:msy");

Route::delete('/staff/logout', [PetugasLoginController::class, 'delete'])->name('logout-petugas');
Route::delete('/staff/tanggapan/{id}', [TanggapanController::class, 'destroy'])->name("destroy-tanggapan");
Route::delete('/staff/logout', [PetugasRegisterController::class, 'destroy'])->name('logout-petugas');


Route::patch('/pengaduan/{id}', [PengaduanController::class, "patch"])->name("update-pengaduan")->middleware("auth:msy");

Route::patch('/staff/tanggapan/{id}', [TanggapanController::class, 'patch'])->name("update-tanggapan")->middleware("auth:petugas");
Route::patch('/staff/register', [PetugasRegisterController::class, 'patch'])->name("update-petugas")->middleware(["auth:petugas", "admin"]);
