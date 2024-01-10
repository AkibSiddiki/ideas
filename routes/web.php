<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IdeaController::class, 'index'])->name('home');

Route::get('/search/{search}', [IdeaController::class, 'index'])->name('ideas.search');

Route::post('/ideas', [IdeaController::class, 'store'])->name('ideas.store')->middleware('auth');

Route::get('/ideas/{idea}', [IdeaController::class, 'show'])->name('ideas.show');

Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit'])->name('ideas.edit')->middleware('auth');

Route::put('/ideas/{idea}', [IdeaController::class, 'update'])->name('ideas.update')->middleware('auth');

Route::post('/ideas/{idea}/comments', [CommentController::class, 'store'])->name('Comments.store')->middleware('auth');

Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy'])->name('ideas.destroy')->middleware('auth');

Route::get('/ideas/{idea}/like', [IdeaController::class, 'like'])->name('ideas.like')->middleware('auth');




Route::get('/terms', function () {
    return view('terms');
})->name('terms');