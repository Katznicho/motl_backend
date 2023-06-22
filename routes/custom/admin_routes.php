<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function(){

    Route::prefix('auth')->group(function () {
        Route::post('register', [UserController::class, 'register']);
        Route::post('login', [UserController::class, 'login']);

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('createUserProfile', [UserController::class, 'createUserProfile']);
            Route::post('updateUserProfile', [UserController::class, 'updateUserProfile']);
            Route::post('logout', [UserController::class, 'logout']);
            Route::post('changePassword', [UserController::class, 'changePassword']);
            Route::post('updateAvatar', [UserController::class, 'updateAvatar']);
        });
    });

});
