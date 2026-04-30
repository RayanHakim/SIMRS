<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\ApotekController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    // --- 1. PROFILE ROUTES (Breeze) ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- 2. MODUL PENDAFTARAN (Admin, Resepsionis, & Pasien) ---
    // Tambahkan 'pasien' di sini agar pendaftaran online bisa diakses mereka
    Route::group(['middleware' => ['role:admin|resepsionis|pasien']], function () {
        Route::resource('pendaftaran', PendaftaranController::class);
    });

    // --- 3. MODUL PEMERIKSAAN (Khusus Dokter) ---
    Route::group(['middleware' => ['role:dokter']], function () {
        Route::get('/pemeriksaan', [PemeriksaanController::class, 'index'])->name('pemeriksaan.index');
        Route::get('/pemeriksaan/{id}/create', [PemeriksaanController::class, 'create'])->name('pemeriksaan.create');
        Route::post('/pemeriksaan/{id}', [PemeriksaanController::class, 'store'])->name('pemeriksaan.store');
    });

    // --- 4. MODUL APOTEK & FARMASI (Admin & Apoteker) ---
    Route::group(['middleware' => ['role:admin|apoteker']], function () {
        Route::get('/apotek', [ApotekController::class, 'index'])->name('apotek.index');
    });

});

require __DIR__.'/auth.php';