<?php

use App\Http\Controllers\GenreController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('genres.index');
});

Route::get('/genres', [GenreController::class, 'index'])->name('genres.index');
Route::get('/genres/{genre:slug}', [GenreController::class, 'show'])->name('genres.show');