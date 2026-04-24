<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlueprintController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login',    [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me',      [AuthController::class, 'me']);
    });
});

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{slug}', [CategoryController::class, 'show']);
Route::get('/categories/{slug}/blueprint', [BlueprintController::class, 'getByCategorySlug']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile',         [UserController::class, 'update']);
    Route::put('/profile',         [UserController::class, 'update']);
    Route::post('/profile/avatar', [UserController::class, 'updateAvatar']);
});

Route::get('/users/{id}', [UserController::class, 'show']);
