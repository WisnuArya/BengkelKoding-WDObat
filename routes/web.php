<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\PoliController;
use App\Models\DaftarPoli;
use App\Models\Periksa;
use App\Http\Controllers\AdminController;

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
    // Route::get('/dashboard-dokter', function () {return view('dashboard'); })->name('dashboard');
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
    Route::get('/jadwal-periksa', [DokterController::class, 'jadwaldokter'])->name('jadwl.dokter');
    Route::get('/tambah-jadwal-periksa', [DokterController::class, 'tambahjadwaldokter']);
    Route::post('/tambah-jadwal-periksa', [DokterController::class, 'storejadwaldokter'])->name('tambah.jadwaldokter');
    Route::get('/edit-jadwal-periksa/{id}', [DokterController::class, 'editjadwaldokter'])->name('edit.jadwaldokte');
    Route::put('/edit-jadwal/{id}', [DokterController::class, 'updatejadwaldokter'])->name('editdokter.update');
    Route::get('/riwayatpasien', [DokterController::class, 'riwayatpasien']);
     Route::get('/jadwal_periksa', [DokterController::class, 'jadwaldokter'])->name('jadwl.dokter');
     Route::get('/tambah_jadwal_periksa', [DokterController::class, 'tambahjadwaldokter']);
});

Route::middleware(['auth', 'role:pasien'])->group(function () {
    Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.index');
    Route::get('/list-dokter', [DokterController::class, 'byDokter'])->name('dokter.index');
    // Route::get('/dashboard-pasien', function () {return view('dashboard'); })->name('dashboard');
    Route::get('/periksa/dokter', [DokterController::class, 'byDokter'])->name('periksa.byDokter');
    Route::post('/periksa/dokter', [DokterController::class, 'byDokter']);
    Route::get('/daftar-poli', [PoliController::class, 'index'])->name('daftar.poli');
    Route::post('/daftar-poli', [PoliController::class, 'daftar'])->name('poli-daftar.create');
    Route::get('/poli', [PoliController::class, 'poli'])->name('poli');
    Route::get('/detail-periksa', [PeriksaController::class, 'lihatDetailPeriksa']);
    Route::get('/detail-periksa/{id}', [PeriksaController::class, 'lihatDetailPeriksa'])->name('lihat.detail.periksa');
});
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/iniadmin', [AdminController::class, 'index']);
    Route::get('/admin-kelola-dokter', [AdminController::class, 'formdokter'])->name('admin.dokter');
    Route::get('/admin-kelola-obat', [AdminController::class, 'formobat'])->name('admin.obat');
    Route::get('/admin-kelola-pasien', [AdminController::class, 'formpasien'])->name('admin.pasien');
    Route::get('/admin-kelola-poli', [AdminController::class, 'formpoli'])->name('admin.poli');
    Route::get('/admin-tambah-dokter', [AdminController::class, 'tambah_dokter']);
    Route::post('/admin-tambah-dokter', [AdminController::class, 'storedokter'])->name('admin.storedokter');
    Route::get('/admin-edit-dokter/{id}', [AdminController::class, 'editdokter'])->name('admin.editdokter');
    Route::put('/admin/updatedokter/{id}', [AdminController::class, 'updatedokter'])->name('admin.updatedokter');
    Route::delete('/admin/deletedokter/{id}', [AdminController::class, 'deleteDokter'])->name('admin.deletedokter');
    Route::get('/admin-tambah-pasien', [AdminController::class, 'tambah_pasien']);
    Route::get('/admin-edit-pasien/{id}', [AdminController::class, 'editpasien'])->name('admin.editpasien');
    Route::post('/admin-tambah-pasien', [AdminController::class, 'storepasien'])->name('admin.storepasien');
    Route::put('/admin/updatepasien/{id}', [AdminController::class, 'updatepasien'])->name('admin.updatepasien');
    Route::delete('/admin/deletepasien/{id}', [AdminController::class, 'deletepasien'])->name('admin.deletepasien');
    Route::get('/admin-tambah-obat', [AdminController::class, 'tambah_obat']);
    Route::get('/admin-edit-obat/{id}', [AdminController::class, 'editobat'])->name('admin.editobat');
    Route::post('/admin-tambah-obat', [AdminController::class, 'storeobat'])->name('admin.storeobat');
    Route::put('/admin/updateobat/{id}', [AdminController::class, 'updateobat'])->name('admin.updateobat');
    Route::delete('/admin/deleteobat/{id}', [AdminController::class, 'deleteobat'])->name('admin.deleteobat');
    Route::get('/admin-tambah-poli', [AdminController::class, 'tambah_poli']);
    Route::post('/admin-tambah-poli', [AdminController::class, 'storepoli'])->name('admin.storepoli');
    Route::get('/admin-tambah-jadwal', [AdminController::class, 'tambah_jadwalpoli']);
    Route::post('/admin-tambah-jadwal', [AdminController::class, 'storejadwal'])->name('admin.storejadwal');
    Route::put('/admin/updatepoli/{id}', [AdminController::class, 'updatepoli'])->name('admin.updatepoli');
    Route::get('/admin-edit-poli/{id}', [AdminController::class, 'editpoli'])->name('admin.editpoli');
    Route::delete('/admin/deletepoli/{id}', [AdminController::class, 'deletepoli'])->name('admin.deletepoli');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/obat', [DashboardController::class, 'count_user'])->name('user.count.user');
    Route::get('/dokter', [DashboardController::class, 'count_user'])->name('user.user');
});