<?php

use App\Http\Controllers\Api\v1\Auth\AuthUserController;
use App\Http\Controllers\Api\v1\Production\ProductionController;
use App\Http\Controllers\Api\v1\User\UserController;
use App\Http\Middleware\UserAccessLevelMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(UserAccessLevelMiddleware::class)->apiResource('production', ProductionController::class);

Route::apiResource('user', UserController::class)
    ->except(['store'])
    ->middleware(UserAccessLevelMiddleware::class);

Route::post('user', [UserController::class, 'store']);

Route::prefix('auth')->group(function () {
    Route::post('login',   [AuthUserController::class, 'login']);
});
