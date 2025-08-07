<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatunganController;
use App\Http\Controllers\KomoditasController;
use App\Http\Controllers\TransaksiController;
use App\Http\Middleware\RoleMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [UserController::class, 'registerForm'])->name('register');
Route::get('/login', [UserController::class, 'loginForm'])->name('login');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// ADMIN ROUTES
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // dashboard
    Route::get('/dashboard', function () {
        return view('welcome');
    })->name('dashboard');
    Route::get('/user', [UserController::class, 'index'])->name('user.index');

    Route::get('/patungan', [PatunganController::class, 'index'])->name('patungan.index');
    Route::get('/patungan/{id}', [PatunganController::class, 'show'])->name('patungan.show');
    Route::post('/patungan', [PatunganController::class, 'store'])->name('patungan.store');
    Route::post('/patungan/pesan/{id}', [PatunganController::class, 'pesan'])->name('patungan.pesan');

    Route::get('/komoditas', [KomoditasController::class, 'index'])->name('komoditas.index');
    Route::post('/komoditas', [KomoditasController::class, 'store'])->name('komoditas.store');
    Route::put('/komoditas/{id}', [KomoditasController::class, 'update'])->name('komoditas.update');
    Route::delete('/komoditas/{id}', [KomoditasController::class, 'delete'])->name('komoditas.delete');
});


// PENGGUNA ROUTES
Route::middleware(['auth', 'role:pengguna'])->prefix('pengguna')->name('pengguna.')->group(function () {
    // dashboard
    Route::get('/dashboard', function () {
        return view('welcome');
    })->name('dashboard');

    Route::get('/patungan', [PatunganController::class, 'indexPengguna'])->name('patungan.index');

    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
});


// GUDANG ROUTES
Route::middleware(['auth', 'role:gudang'])->prefix('gudang')->name('gudang.')->group(function () {
    // dashboard
    Route::get('/dashboard', function () {
        return view('welcome');
    })->name('dashboard');

    Route::get('/kiriman', [PatunganController::class, 'kiriman'])->name('patungan.kiriman');
    Route::post('/kiriman/datang/{id}', [PatunganController::class, 'datang'])->name('patungan.datang');

    Route::get('/barang', [TransaksiController::class, 'barang'])->name('patungan.barang');

});
