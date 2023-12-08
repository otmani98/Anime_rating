<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

//public routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

//protected routes with auth
Route::group(['middleware' => ['auth:sanctum']], function ()  {
    Route::post('logout', [AuthController::class, 'logout']);
});
