<?php

use App\Http\Controllers\StudioController;

//public

Route::get('studios', [StudioController::class, 'index']);

Route::get('studios/{id}', [StudioController::class, 'show'])->where('id', '[0-9]+');


//protected routes for admin
Route::group(['middleware' => ['auth:sanctum', 'isadmin']], function ()  {

    Route::post('studios', [StudioController::class, 'store']);

    Route::put('studios/{id}', [StudioController::class, 'update'])->where('id', '[0-9]+');

    Route::delete('studios/{id}', [StudioController::class, 'destroy'])->where('id', '[0-9]+');

});

