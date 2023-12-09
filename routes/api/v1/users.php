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
});

//protected routes with auth for admin
Route::group(['middleware' => ['auth:sanctum', 'isadmin']], function ()  {

    Route::patch('users/{userName}/roles/{role}', [UserController::class, 'changeRule'])->whereAlphaNumeric('userName')->whereNumber('role');

    Route::patch('users/{userName}/active/{status}', [UserController::class, 'toggleUserActive'])->whereAlphaNumeric('userName')->where('status', '[0-1]');

});