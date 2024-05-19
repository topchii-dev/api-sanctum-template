<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('connection-test', function () {
    return response("I'm alive");
});

// Authentication routes
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    // Authentication routes
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [UserController::class, 'me']);
});