<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/users/create', [AuthController::class, 'create'])->name('auth.create');

Route::post('/users', [AuthController::class, 'store'])->name('auth.store');

Route::get('/users/login', [AuthController::class, 'login'])->name('auth.login');

Route::post('/users/loginAction', [AuthController::class, 'loginAction'])->name('users.loginAction');

Route::get('/users/logout', [AuthController::class, 'logout'])->name('logout');

// --------------------

Route::get('/', [IdeaController::class, 'index'])->name('home');

Route::get('/search/{search}', [IdeaController::class, 'index'])->name('ideas.search');

Route::post('/ideas', [IdeaController::class, 'store'])->name('ideas.store')->middleware('auth');

Route::get('/ideas/{idea}', [IdeaController::class, 'show'])->name('ideas.show');

Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit'])->name('ideas.edit')->middleware('auth');

Route::put('/ideas/{idea}', [IdeaController::class, 'update'])->name('ideas.update')->middleware('auth');

Route::post('/ideas/{idea}/comments', [CommentController::class, 'store'])->name('Comments.store')->middleware('auth');

Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy'])->name('ideas.destroy')->middleware('auth');

Route::get('/ideas/{idea}/like', [IdeaController::class, 'like'])->name('ideas.like')->middleware('auth');

Route::get('/users/{id}/profile', [UserController::class, 'show'])->name('Users.show');

Route::get('/users/{id}/profile/edit', [UserController::class, 'edit'])->name('Users.edit')->middleware('auth');

Route::post('/users/{user}', [UserController::class, 'update'])->name('Users.update')->middleware('auth');

Route::post('/users/{user}/follow', [FollowController::class, 'follow'])->name('follow')->middleware('auth');

Route::post('/users/{user}/unfollow', [FollowController::class, 'unfollow'])->name('unfollow')->middleware('auth');




Route::get('/terms', function () {
    return view('terms');
})->name('terms');
