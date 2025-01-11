<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventarisController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::post('/register', [AuthController::class, 'proses_register'])->name('proses_register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk halaman dashboard setelah login
Route::get('/dashboard', function () {
    return view('dashboard'); // Pastikan view 'dashboard' ada
})->name('dashboard')->middleware('auth');


// Route for displaying the dashboard page
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
// Route untuk halaman utama inventaris (menampilkan daftar inventaris)
Route::get('/inventaris', [InventarisController::class, 'index'])->name('inventaris.index')->middleware('auth');

// Route untuk form menambah inventaris
Route::get('/inventaris/create', [InventarisController::class, 'create'])->name('inventaris.create');

// Route untuk menyimpan data inventaris
Route::post('/inventaris', [InventarisController::class, 'store'])->name('inventaris.store')->middleware('auth');

// Route untuk form mengedit data inventaris
Route::get('/inventaris/{inventaris}/edit', [InventarisController::class, 'edit'])->name('inventaris.edit')->middleware('auth');

// Route untuk memperbarui data inventaris
Route::put('/inventaris/{inventaris}', [InventarisController::class, 'update'])->name('inventaris.update')->middleware('auth');

// Route untuk menghapus inventaris
Route::delete('/inventaris/{inventaris}', [InventarisController::class, 'destroy'])->name('inventaris.destroy')->middleware('auth');

Route::get('/inventaris/{id}', [InventarisController::class, 'show'])->name('inventaris.show');
