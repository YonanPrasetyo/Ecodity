<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
