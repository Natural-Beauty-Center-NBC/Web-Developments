<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\InformasiKlinikController;
use App\Http\Controllers\Api\PegawaiController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// AUTHENTICATION'S ENDPOINT :
Route::post('login', [AuthenticationController::class, 'login']);
Route::post('register', [AuthenticationController::class, 'register']);

// GUEST ENDPOINT'S ACCESS (PUBLIC) :
Route::get('get-perawatans', [InformasiKlinikController::class, 'getPerawatansData']);
Route::get('get-produks', [InformasiKlinikController::class, 'getProduksData']);
Route::get('get-jadwal-dokter', [InformasiKlinikController::class, 'getJadwalDokter']);
Route::get('get-jadwal-beautician', [InformasiKlinikController::class, 'getJadwalBeautician']);

// BEAUTICIAN ENDPOINT'S ACCESS :
Route::get('get-pegawai/{id}', [PegawaiController::class, 'getPegawaiData']);


// CUSTOMER ENDPOINT'S ACCESS :
Route::get('get-customer/{id}', [UserController::class, 'getUserData']);
Route::get('get-customer-transaction-history/{id}', [UserController::class, 'getUserTransactionHistory']);