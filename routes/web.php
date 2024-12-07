<?php

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\PenjadwalanController;
use App\Http\Controllers\PerawatanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
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
    Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/customer-card/{id}', [UserController::class, 'generateCustomerCard'])->name('profile.card-customer');
    Route::put('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
});

// ADMIN ROLE ROUTE ACCESS :
Route::middleware(AdminAccess::class)->group(function () {
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
Route::middleware(KepalaKlinikAccess::class)->group(function () {
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

    // PROMO :
    Route::get('/kepala-klinik/promo', [PromoController::class, 'index'])->name('kepala-klinik.index-promo');
    Route::get('/kepala-klinik/promo/create', [PromoController::class, 'create'])->name('kepala-klinik.create-promo');
    Route::post('/kepala-klinik/promo', [PromoController::class, 'store'])->name('kepala-klinik.store-promo');
    Route::get('/kepala-klinik/promo/{id}', [PromoController::class, 'edit'])->name('kepala-klinik.edit-promo');
    Route::put('/kepala-klinik/promo/{id}', [PromoController::class, 'update'])->name('kepala-klinik.update-promo');
    Route::delete('/kepala-klinik/promo/{id}', [PromoController::class, 'destroy'])->name('kepala-klinik.destroy-promo');

    // LAPORAN :
    Route::get('/kepala-klinik/laporan-customer-baru', [LaporanController::class, 'get_laporan_customer_baru'])->name('kepala-klinik.laporan-customer-baru');
    Route::get('/kepala-klinik/laporan-pendapatan', [LaporanController::class, 'get_laporan_pendapatan'])->name('kepala-klinik.laporan-pendapatan');
    Route::get('/kepala-klinik/laporan-jumlah-customer', [LaporanController::class, 'get_laporan_jumlah_customer'])->name('kepala-klinik.laporan-jumlah-customer');
    Route::get('/kepala-klinik/laporan-produk-terlaris', [LaporanController::class, 'get_laporan_produk_terlaris'])->name('kepala-klinik.laporan-produk-terlaris');
    Route::get('/kepala-klinik/laporan-perawatan-terlaris', [LaporanController::class, 'get_laporan_perawatan_terlaris'])->name('kepala-klinik.laporan-perawatan-terlaris');

    // PDF :
    Route::get('/kepala-klinik/download-laporan-customer-baru', [LaporanController::class, 'generate_pdf_laporan_customer_baru'])->name('kepala-klinik.download-laporan-customer-baru');
    Route::get('/kepala-klinik/download-laporan-pendapatan', [LaporanController::class, 'generate_pdf_laporan_pendapatan'])->name('kepala-klinik.download-laporan-pendapatan');
    Route::get('/kepala-klinik/download-laporan-jumlah-customer', [LaporanController::class, 'generate_pdf_laporan_jumlah_customer'])->name('kepala-klinik.download-laporan-jumlah-customer');
    Route::get('/kepala-klinik/download-laporan-produk-terlaris', [LaporanController::class, 'generate_pdf_laporan_produk_terlaris'])->name('kepala-klinik.download-laporan-produk-terlaris');
    Route::get('/kepala-klinik/download-laporan-perawatan-terlaris', [LaporanController::class, 'generate_pdf_laporan_perawatan_terlaris'])->name('kepala-klinik.download-laporan-perawatan-terlaris');
});

// CUSTROMER SERVICE ROLE ROUTE ACCESS :
Route::middleware(CustomerServiceAccess::class)->group(function () {
    Route::get('/customer-service', [PegawaiController::class, 'home_customer_service'])->name('customer-service.home');

    // DATA CUSTOMER :
    Route::get('/customer-service/customer', [UserController::class, 'index'])->name('customer-service.index-customer');
    Route::get('/customer-service/create', [UserController::class, 'create'])->name('customer-service.create-customer');
    Route::get('/customer-service/detail/{id}', [UserController::class, 'show'])->name('customer-service.detail-customer');
    Route::post('/customer-service/customer', [UserController::class, 'store'])->name('customer-service.store-customer');
    Route::get('/customer-service/customer/{id}', [UserController::class, 'edit'])->name('customer-service.edit-customer');
    Route::put('/customer-service/customer/{id}', [UserController::class, 'update'])->name('customer-service.update-customer');
    Route::delete('/customer-service/customer/{id}', [UserController::class, 'destroy'])->name('customer-service.destroy-customer');
    Route::get('/customer-service/customer/card/{id}', [UserController::class, 'generateCustomerCard'])->name('customer-service.card-customer');

    // TRANSAKSI:
    Route::get('/customer-service/transaksi/create', [TransaksiController::class, 'create'])->name('customer-service.create-transaksi');
    Route::get('/customer-service/transaksi/{tipe}', [TransaksiController::class, 'transaksi_dengan_konsultasi'])->name('customer-service.dengan-konsultasi');
    Route::get('/customer-service/transaksi/tanpa-konsultasi/create', [TransaksiController::class, 'transaksi_tanpa_konsultasi'])->name('customer-service.tanpa-konsultasi');
    Route::post('/customer-service/transaksi/dengan-konsultasi', [TransaksiController::class, 'store_dengan_konsultasi'])->name('customer-service.store-dengan-konsultasi');
    Route::post('/customer-service/transaksi/tanpa-konsultasi', [TransaksiController::class, 'store_tanpa_konsultasi'])->name('customer-service.store-tanpa-konsultasi');
});

// DOKTER ROLE ROUTE ACCESS :
Route::middleware(DokterAccess::class)->group(function () {

    // PEMERIKSAAN :
    Route::get('/dokter/get-queue', [PemeriksaanController::class, 'index'])->name('dokter.queue');
    Route::get('/dokter/riwayat-pemeriksaan/{id}', [PemeriksaanController::class, 'getRiwayatPemeriksaan'])->name('dokter.riwayat-pemeriksaan');
    Route::get('/dokter/input-pemeriksaan/create-perawatan/{id}', [PemeriksaanController::class, 'create_input_perawatan'])->name('dokter.create-input-perawatan');
    Route::get('/dokter/input-pemeriksaan/create-produk/{id}', [PemeriksaanController::class, 'create_input_produk'])->name('dokter.create-input-produk');
    Route::post('/dokter/input-pemeriksaan-perawatan', [PemeriksaanController::class, 'store_input_perawatan'])->name('dokter.input-perawatan');
    Route::post('/dokter/input-pemeriksaan-produk', [PemeriksaanController::class, 'store_input_produk'])->name('dokter.input-produk');

    Route::get('/dokter/edit-pemeriksaan-perawatan/{id}', [PemeriksaanController::class, 'edit_pemeriksaan_perawatan'])->name('dokter.edit-perawatan');
    Route::get('/dokter/edit-pemeriksaan-produk/{id}', [PemeriksaanController::class, 'edit_pemeriksaan_produk'])->name('dokter.edit-produk');
    Route::put('/dokter/update-pemeriksaan-produk/{id}', [PemeriksaanController::class, 'update_jumlah_produk'])->name('dokter.update-produk');
    Route::delete('/dokter/delete-produk/{id}', [PemeriksaanController::class, 'delete_produk'])->name('dokter.delete-produk');

    Route::put('/dokter/update-pemeriksaan-perawatan/{id}', [PemeriksaanController::class, 'update_pemeriksaan_perawatan'])->name('dokter.update-perawatan');
    Route::get('/dokter/mark-as-done/{id}', [PemeriksaanController::class, 'markAsDone'])->name('dokter.mark-as-done');
});

// KASIR ROLE ROUTE ACCESS :
Route::middleware(KasirAccess::class)->group(function () {

    // PEMBAYARAN
    Route::get('/kasir/get-transaksi-pending', [PembayaranController::class, 'index'])->name('kasir.daftar-pending');
    Route::get('/kasir/detail-pembayaran/{id}', [PembayaranController::class, 'create'])->name('kasir.detail-pembayaran');
    Route::post('/kasir/pembayaran/{id}', [PembayaranController::class, 'payment'])->name('kasir.pembayaran');
    Route::get('/kasir/get-transaksi-paid', [PembayaranController::class, 'index_paid'])->name('kasir.daftar-paid');
    Route::post('/kasir/redeem/{id}', [PembayaranController::class, 'redeemPoints'])->name('kasir.redeem-point');
    
    // GENERATE INVOICE
    Route::get('/kasir/get-invoice/{id}', [PembayaranController::class, 'generateInvoice'])->name('kasir.generate-invoice');
});

require __DIR__ . '/auth.php';