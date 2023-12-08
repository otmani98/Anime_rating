<?php

use App\Http\Controllers\AnimeController;

Route::get('animes', [AnimeController::class, 'index']);

Route::get('animes/{id}', [AnimeController::class, 'show'])->where('id', '[0-9]+');

Route::post('animes', [AnimeController::class, 'store']);

Route::put('animes/{id}', [AnimeController::class, 'update'])->where('id', '[0-9]+');

Route::delete('animes/{id}', [AnimeController::class, 'destroy'])->where('id', '[0-9]+');

