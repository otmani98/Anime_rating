<?php

use App\Http\Controllers\AnimeController;

//public routes

Route::get('animes', [AnimeController::class, 'index']);

Route::get('animes/{id}', [AnimeController::class, 'show'])->where('id', '[0-9]+');


//protected routes with auth
Route::group(['middleware' => ['auth:sanctum']], function ()  {


});



//protected routes for admin
Route::group(['middleware' => ['auth:sanctum', 'isadmin']], function ()  {

  Route::post('animes', [AnimeController::class, 'store']);

  Route::put('animes/{id}', [AnimeController::class, 'update'])->where('id', '[0-9]+');

  Route::delete('animes/{id}', [AnimeController::class, 'destroy'])->where('id', '[0-9]+');


});


//protected routes with auth
//user can rate anime
//user can add anime to their fav list