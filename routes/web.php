<?php

use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminAccess;
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
});

// TODO -> Put the route here including the middleware (Similiar with ADMIN ROLE ROUTE ACCESS)
// DOKTER ROLE ROUTE ACCESS:

// CUSTROMER SERVICE ROLE ROUTE ACCESS:

// KEPALA KLINIK ROLE ROUTE ACCESS:

// KASIR ROLE ROUTE ACCESS:

// BEAUTICIAN ROLE ROUTE ACCESS:

require __DIR__.'/auth.php';

/*
Route::get('/dashboard', function () {
    return view('public.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/