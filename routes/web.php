<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicAdoptionController;
use App\Http\Controllers\PublicPostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/publicaciones', [PublicPostController::class, 'index'])->name('posts.index');
Route::get('/publicaciones/{post}', [PublicPostController::class, 'show'])->name('posts.show');

Route::get('/adopciones', [PublicAdoptionController::class, 'index'])->name('adoptions.index');
Route::get('/adopciones/{post}', [PublicAdoptionController::class, 'show'])->name('adoptions.show');
