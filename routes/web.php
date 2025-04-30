<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PasienController;

Route::get('/', function () {
    return view('login');
});
Route::get('/list-dokter', function () {
    $dokters = User::where('role', 'dokter')->get();
    return view('list-dokter', compact('dokters'));
});

Route::get('/login', [AuthController::class, 'form'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'formRegister'])->name('daftar');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth', 'role:dokter'])->group(function () {
    Route::get('/dashboard-dokter', function () {return view('dashboard'); })->name('dashboard');
    Route::get('/obat', [ObatController::class, 'index'])->name('obat.index');
    Route::get('/list-obat', [ObatController::class, 'obat'])->name('obat.index');
    Route::get('/obat/{id}/edit', [ObatController::class, 'edit'])->name('obat.edit');
    Route::put('/obat/{id}', [ObatController::class, 'update'])->name('obat.update');
    Route::post('/obat', [ObatController::class, 'store'])->name('obat.store');
    Route::get('/obat/create', [ObatController::class, 'create'])->name('obat.create');
    Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.index');
    Route::delete('/obat/{id}', [ObatController::class, 'destroy'])->name('obat.destroy'); 
    Route::get('/periksa', [PasienController::class, 'pasien'])->name('pasien.index');
    Route::get('/edit-periksa/{id}/edit', [PasienController::class, 'edit'])->name('pasien.edit');
    Route::put('/edit-periksa/{id}', [PasienController::class, 'update'])->name('pasien.update');
});

Route::middleware(['auth', 'role:pasien'])->group(function () {
    Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.index');
    Route::get('/list-dokter', [DokterController::class, 'byDokter'])->name('dokter.index');
    Route::get('/dashboard-pasien', function () {return view('dashboard'); })->name('dashboard');
    Route::get('/periksa/dokter', [DokterController::class, 'byDokter'])->name('periksa.byDokter');
    Route::post('/periksa/dokter', [DokterController::class, 'byDokter']);
});