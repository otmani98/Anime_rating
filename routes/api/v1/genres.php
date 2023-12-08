<?php

use App\Http\Controllers\GenreController;

Route::get('genres', [GenreController::class, 'index']);

Route::get('genres/{id}', [GenreController::class, 'show'])->where('id', '[0-9]+');

Route::post('genres', [GenreController::class, 'store']);

Route::put('genres/{id}', [GenreController::class, 'update'])->where('id', '[0-9]+');

Route::delete('genres/{id}', [GenreController::class, 'destroy'])->where('id', '[0-9]+');

