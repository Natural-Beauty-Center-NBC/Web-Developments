<?php

use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PenjadwalanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShiftController;
use App\Http\Middleware\AdminAccess;
use App\Http\Middleware\KepalaKlinikAccess;
use App\Models\Penjadwalan;
use App\Models\Shift;
use Illuminate\Support\Facades\Route;

// STARTING ROUTE :
Route::get('/', function () {
    return view('public.home');
})->name('public.home');

// CUSTOMER ROUTE ACCESS :
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ADMIN ROLE ROUTE ACCESS:
Route::middleware(AdminAccess::class)->group(function() {
    Route::get('/admin', [PegawaiController::class, 'index_admin'])->name('admin.home');

    Route::get('/admin/data-pegawai', [PegawaiController::class, 'index_data_pegawai'])->name('admin.index-pegawai');
    Route::get('/admin/data-pegawai/create', [PegawaiController::class, 'create_data_pegawai'])->name('admin.create-pegawai');
    Route::post('/admin/data-pegawai', [PegawaiController::class, 'store_data_pegawai'])->name('admin.store-pegawai');
    Route::get('/admin/data-pegawai/{id}', [PegawaiController::class, 'edit_data_pegawai'])->name('admin.edit-pegawai');
    Route::put('/admin/data-pegawai/{id}', [PegawaiController::class, 'update_data_pegawai'])->name('admin.update-pegawai');
    Route::delete('/admin/data-pegawai/{id}', [PegawaiController::class, 'destroy_data_pegawai'])->name('admin.destroy-pegawai');
});

// KEPALA KLINIK ROLE ROUTE ACCESS:
Route::middleware(KepalaKlinikAccess::class)->group(function() {
    Route::get('/kepala-klinik', [PegawaiController::class, 'home_kepala_klinik'])->name('kepala-klinik.home');

    Route::get('/kepala-klinik/penjadwalan', [PenjadwalanController::class, 'index'])->name('kepala-klinik.index-penjadwalan');
    Route::get('/kepala-klinik/penjadwalan/create', [PenjadwalanController::class, 'create'])->name('kepala-klinik.create-penjadwalan');
    Route::post('/kepala-klinik/penjadwalan', [PenjadwalanController::class, 'store'])->name('kepala-klinik.store-penjadwalan');
    Route::get('/kepala-klinik/penjadwalan/{id}', [PenjadwalanController::class, 'edit'])->name('kepala-klinik.edit-penjadwalan');
    Route::put('/kepala-klinik/penjadwalan/{id}', [PenjadwalanController::class, 'update'])->name('kepala-klinik.update-penjadwalan');
    Route::delete('/kepala-klinik/penjadwalan/{id}', [PenjadwalanController::class, 'destroy'])->name('kepala-klinik.destroy-penjadwalan');

    Route::get('/kepala-klinik/shift', [ShiftController::class, 'index'])->name('kepala-klinik.index-shift');
    Route::get('/kepala-klinik/shift/create', [ShiftController::class, 'create'])->name('kepala-klinik.create-shift');
    Route::post('/kepala-klinik/shift', [ShiftController::class, 'store'])->name('kepala-klinik.store-shift');
    Route::get('/kepala-klinik/shift/{id}', [ShiftController::class, 'edit'])->name('kepala-klinik.edit-shift');
    Route::put('/kepala-klinik/shift/{id}', [ShiftController::class, 'update'])->name('kepala-klinik.update-shift');
    Route::delete('/kepala-klinik/shift/{id}', [ShiftController::class, 'destroy'])->name('kepala-klinik.destroy-shift');
});

// TODO -> Put the route here including the middleware (Similiar with ADMIN ROLE ROUTE ACCESS)
// DOKTER ROLE ROUTE ACCESS:

// CUSTROMER SERVICE ROLE ROUTE ACCESS:

// KASIR ROLE ROUTE ACCESS:

// BEAUTICIAN ROLE ROUTE ACCESS:

require __DIR__.'/auth.php';

/*
Route::get('/dashboard', function () {
    return view('public.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/