<?php

use App\Http\Controllers\Api\AuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// STARTER ENDPOINT :
Route::post('login', [AuthenticationController::class, 'login']);
Route::post('register', [AuthenticationController::class, 'register']);

// GUEST ENDPOINT'S ACCESS (PUBLIC) :


// BEAUTICIAN ENDPOINT'S ACCESS :


// CUSTOMER ENDPOINT'S ACCESS :