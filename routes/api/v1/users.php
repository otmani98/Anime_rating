<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavRatingController;

//public routes
Route::post('register', [AuthController::class, 'register']);

Route::post('login', [AuthController::class, 'login']);

//protected routes with auth
Route::group(['middleware' => ['auth:sanctum']], function ()  {

    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('users/animefavorites', [FavRatingController::class, 'getMyFavoritesAnime']);

    Route::post('users/animefavorites/{animeid}', [FavRatingController::class, 'addAnimeToMyFavorites']);

    Route::delete('users/animefavorites/{animeid}', [FavRatingController::class, 'destroyAnimeFromMyFavorites']);

    Route::get('users/myratings', [FavRatingController::class, 'getMyRatings']);

    Route::post('users/myratings', [FavRatingController::class, 'addRatingToAnime']);
    
    Route::delete('users/myratings', [FavRatingController::class, 'destroyRatingOfAnime']);

});

//protected routes with auth for admin
Route::group(['middleware' => ['auth:sanctum', 'isadmin']], function ()  {

    Route::patch('users/{userName}/roles/{role}', [UserController::class, 'changeRule']);

    Route::patch('users/{userName}/active/{status}', [UserController::class, 'toggleUserActive']);

});