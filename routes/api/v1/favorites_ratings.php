<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavRatingController;

//protected routes with auth
Route::group(['middleware' => ['auth:sanctum']], function ()  {

    Route::get('animefavorites', [FavRatingController::class, 'getMyFavoritesAnime']);

    Route::post('animefavorites/{animeid}', [FavRatingController::class, 'addAnimeToMyFavorites'])->where('animeid', '[0-9]+');

    Route::delete('animefavorites/{animeid}', [FavRatingController::class, 'destroyAnimeFromMyFavorites'])->where('animeid', '[0-9]+');

    Route::get('myratings', [FavRatingController::class, 'getMyRatings']);

    Route::post('myratings', [FavRatingController::class, 'addOrUpdateRatingToAnime']);
    
    Route::delete('myratings', [FavRatingController::class, 'destroyRatingOfAnime']);

});