<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/users/create', [AuthController::class, 'create'])->name('auth.create');

Route::post('/users', [AuthController::class, 'store'])->name('auth.store');

Route::get('/users/login', [AuthController::class, 'login'])->name('auth.login');

Route::post('/users/login-action', [AuthController::class, 'loginAction'])->name('users.loginAction');

Route::get('/users/logout', [AuthController::class, 'logout'])->name('logout');