<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Api\InventarisController;

// Rute untuk menambah inventaris
Route::post('/inventaris', [InventarisController::class, 'store']);

// Rute untuk mengambil seluruh data inventaris
Route::get('/inventaris', [InventarisController::class, 'index']);

// Rute untuk mengambil data inventaris berdasarkan ID
Route::get('/inventaris/{id}', [InventarisController::class, 'show']);

// Rute untuk mengupdate data inventaris berdasarkan ID
Route::put('/inventaris/{id}', [InventarisController::class, 'update']);

// Rute untuk menghapus data inventaris berdasarkan ID
Route::delete('/inventaris/{id}', [InventarisController::class, 'destroy']);



Route::post('/login', [LoginController::class, 'login']);
