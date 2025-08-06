<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatunganController;
use App\Http\Controllers\KomoditasController;
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

    Route::get('/komoditas', [KomoditasController::class, 'index'])->name('komoditas.index');
});


// PENGGUNA ROUTES
Route::middleware(['auth', 'role:pengguna'])->prefix('pengguna')->name('pengguna.')->group(function () {
    // dashboard
    Route::get('/dashboard', function () {
        return view('welcome');
    })->name('dashboard');
});


// GUDANG ROUTES
Route::middleware(['auth', 'role:gudang'])->prefix('gudang')->name('gudang.')->group(function () {
    // dashboard
    Route::get('/dashboard', function () {
        return view('welcome');
    })->name('dashboard');
});
