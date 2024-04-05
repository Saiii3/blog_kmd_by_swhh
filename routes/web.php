<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', [PostController::class, 'welcome'])->name('welcome');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/media', [PostController::class, 'media'])->name('media');
Route::get('/csr', [PostController::class, 'csr'])->name('csr');
Route::get('/detailpost/{id}', [PostController::class, 'detail'])->name('detailpost.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('posts', PostController::class);
});

require __DIR__ . '/auth.php';
