<?php

use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PenjadwalanController;
use App\Http\Controllers\PerawatanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\TransaksiController;
use App\Http\Middleware\AdminAccess;
use App\Http\Middleware\CustomerServiceAccess;
use App\Http\Middleware\DokterAccess;
use App\Http\Middleware\KasirAccess;
use App\Http\Middleware\KepalaKlinikAccess;
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

// ADMIN ROLE ROUTE ACCESS :
Route::middleware(AdminAccess::class)->group(function() {
    Route::get('/admin', [PegawaiController::class, 'home_admin'])->name('admin.home');

    // DATA PEGAWAI :
    Route::get('/admin/data-pegawai', [PegawaiController::class, 'index_data_pegawai'])->name('admin.index-pegawai');
    Route::get('/admin/data-pegawai/create', [PegawaiController::class, 'create_data_pegawai'])->name('admin.create-pegawai');
    Route::post('/admin/data-pegawai', [PegawaiController::class, 'store_data_pegawai'])->name('admin.store-pegawai');
    Route::get('/admin/data-pegawai/{id}', [PegawaiController::class, 'edit_data_pegawai'])->name('admin.edit-pegawai');
    Route::put('/admin/data-pegawai/{id}', [PegawaiController::class, 'update_data_pegawai'])->name('admin.update-pegawai');
    Route::delete('/admin/data-pegawai/{id}', [PegawaiController::class, 'destroy_data_pegawai'])->name('admin.destroy-pegawai');

    // DATA PRODUK :
    Route::get('/admin/produk', [ProdukController::class, 'index'])->name('admin.index-produk'); 
    Route::get('/admin/produk/create', [ProdukController::class, 'create'])->name('admin.create-produk'); 
    Route::post('/admin/produk', [ProdukController::class, 'store'])->name('admin.store-produk'); 
    Route::get('/admin/produk/{id}/edit', [ProdukController::class, 'edit'])->name('admin.edit-produk'); 
    Route::put('/admin/produk/{id}', [ProdukController::class, 'update'])->name('admin.update-produk'); 
    Route::delete('/admin/produk/{id}', [ProdukController::class, 'destroy'])->name('admin.destroy-produk');
    Route::get('/admin/produk/search', [ProdukController::class, 'search'])->name('admin.search-produk');

    // DATA PERAWATAN :
    Route::get('/admin/perawatan', [PerawatanController::class, 'index'])->name('admin.index-perawatan');
    Route::get('/admin/perawatan/create', [PerawatanController::class, 'create'])->name('admin.create-perawatan');
    Route::post('/admin/perawatan', [PerawatanController::class, 'store'])->name('admin.store-perawatan');
    Route::get('/admin/perawatan/{id}', [PerawatanController::class, 'edit'])->name('admin.edit-perawatan');
    Route::put('/admin/perawatan/{id}', [PerawatanController::class, 'update'])->name('admin.update-perawatan');
    Route::delete('/admin/perawatan/{id}', [PerawatanController::class, 'destroy'])->name('admin.destroy-perawatan');

    // DATA RUANGAN :
    Route::get('/admin/ruangan', [RuanganController::class, 'index'])->name('admin.index-ruangan');
    Route::post('/admin/ruangan', [RuanganController::class, 'store'])->name('admin.store-ruangan');
    Route::get('/admin/ruangan/{id}', [RuanganController::class, 'edit'])->name('admin.edit-ruangan');
    Route::put('/admin/ruangan/{id}', [RuanganController::class, 'update'])->name('admin.update-ruangan');
    Route::delete('/admin/ruangan/{id}', [RuanganController::class, 'destroy'])->name('admin.destroy-ruangan');
});

// KEPALA KLINIK ROLE ROUTE ACCESS:
Route::middleware(KepalaKlinikAccess::class)->group(function() {
    Route::get('/kepala-klinik', [PegawaiController::class, 'home_kepala_klinik'])->name('kepala-klinik.home');

    // PENJADWALAN :
    Route::get('/kepala-klinik/penjadwalan', [PenjadwalanController::class, 'index'])->name('kepala-klinik.index-penjadwalan');
    Route::get('/kepala-klinik/penjadwalan/create', [PenjadwalanController::class, 'create'])->name('kepala-klinik.create-penjadwalan');
    Route::post('/kepala-klinik/penjadwalan', [PenjadwalanController::class, 'store'])->name('kepala-klinik.store-penjadwalan');
    Route::get('/kepala-klinik/penjadwalan/{id}', [PenjadwalanController::class, 'edit'])->name('kepala-klinik.edit-penjadwalan');
    Route::put('/kepala-klinik/penjadwalan/{id}', [PenjadwalanController::class, 'update'])->name('kepala-klinik.update-penjadwalan');
    Route::delete('/kepala-klinik/penjadwalan/{id}', [PenjadwalanController::class, 'destroy'])->name('kepala-klinik.destroy-penjadwalan');

    // SHIFT :
    Route::get('/kepala-klinik/shift', [ShiftController::class, 'index'])->name('kepala-klinik.index-shift');
    Route::get('/kepala-klinik/shift/create', [ShiftController::class, 'create'])->name('kepala-klinik.create-shift');
    Route::post('/kepala-klinik/shift', [ShiftController::class, 'store'])->name('kepala-klinik.store-shift');
    Route::get('/kepala-klinik/shift/{id}', [ShiftController::class, 'edit'])->name('kepala-klinik.edit-shift');
    Route::put('/kepala-klinik/shift/{id}', [ShiftController::class, 'update'])->name('kepala-klinik.update-shift');
    Route::delete('/kepala-klinik/shift/{id}', [ShiftController::class, 'destroy'])->name('kepala-klinik.destroy-shift');
});

// CUSTROMER SERVICE ROLE ROUTE ACCESS :
Route::middleware(CustomerServiceAccess::class)->group(function() {
    Route::get('/customer-service', [PegawaiController::class, 'home_customer_service'])->name('customer-service.home');

    // DATA CUSTOMER :
    // TODO -> Put your route's code here!!

    // TRANSAKSI :
    Route::get('/customer-service/transaksi/create', [TransaksiController::class, 'create'])->name('customer-service.create-transaksi');
    Route::get('/customer-service/transaksi/{tipe}', [TransaksiController::class, 'transaksi_dengan_konsultasi'])->name('customer-service.dengan-konsultasi');
    Route::get('/customer-service/transaksi/tanpa-konsultasi', [TransaksiController::class, 'transaksi_tanpa_konsultasi'])->name('customer-service.tanpa-konsultasi');
    Route::post('/customer-service/transaksi/dengan-konsultasi', [TransaksiController::class, 'store_dengan_konsultasi'])->name('customer-service.store-dengan-konsultasi');
    Route::post('/customer-service/transaksi/tanpa-konsultasi', [TransaksiController::class, 'store_tanpa_konsultasi'])->name('customer-service.store-tanpa-konsultasi');
});

// DOKTER ROLE ROUTE ACCESS :
Route::middleware(DokterAccess::class)->group(function() {
    Route::get('/dokter', [PegawaiController::class, 'home_dokter'])->name('dokter.home');

    // TODO -> Put your route's code here!!
});

// KASIR ROLE ROUTE ACCESS :
Route::middleware(KasirAccess::class)->group(function() {
    Route::get('/kasir', [PegawaiController::class, 'home_kasir'])->name('kasir.home');

    // TODO -> Put your route's code here!!
});

require __DIR__.'/auth.php';