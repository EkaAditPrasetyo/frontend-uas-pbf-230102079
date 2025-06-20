<?php
//Eka Adit Prasetyo
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienController;

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

Route::get('/', function () {
    return view('welcome');
});

// ROUTE UNTUK OBAT
Route::get('/obat', [ObatController::class, 'index'])->name('obat.index'); // dashboard
Route::get('/obat/create', [ObatController::class, 'create'])->name('obat.create'); // form tambah
Route::post('/obat', [ObatController::class, 'store'])->name('obat.store'); // simpan
Route::get('/obat/{id}/edit', [ObatController::class, 'edit'])->name('obat.edit'); // form edit
Route::put('/obat/{id}', [ObatController::class, 'update'])->name('obat.update'); // simpan perubahan
Route::delete('/obat/{id}', [ObatController::class, 'destroy'])->name('obat.destroy'); // hapus

// ROUTE UNTUK PASIEN
Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.index'); // dashboard
Route::get('/pasien/create', [PasienController::class, 'create'])->name('pasien.create'); // form tambah
Route::post('/pasien', [PasienController::class, 'store'])->name('pasien.store'); // simpan
Route::get('/pasien/{id}/edit', [PasienController::class, 'edit'])->name('pasien.edit'); // form edit
Route::put('/pasien/{id}', [PasienController::class, 'update'])->name('pasien.update'); // simpan perubahan
Route::delete('/pasien/{id}', [PasienController::class, 'destroy'])->name('pasien.destroy'); // hapus
