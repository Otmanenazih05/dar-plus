<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlueprintController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyMediaController;
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

Route::get('/properties', [PropertyController::class, 'index']);
Route::get('/properties/{id}', [PropertyController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile',         [UserController::class, 'update']);
    Route::put('/profile',         [UserController::class, 'update']);
    Route::post('/profile/avatar', [UserController::class, 'updateAvatar']);

    Route::post('/properties',                           [PropertyController::class, 'store']);
    Route::put('/properties/{id}',                       [PropertyController::class, 'update']);
    Route::delete('/properties/{id}',                    [PropertyController::class, 'destroy']);
    Route::post('/properties/{id}/publish',              [PropertyController::class, 'publish']);
    Route::post('/properties/{id}/sold',                 [PropertyController::class, 'markAsSold']);
    Route::post('/properties/{id}/toggle-archive',       [PropertyController::class, 'toggleArchive']);

    Route::post('/properties/{id}/media',                [PropertyMediaController::class, 'upload']);
    Route::delete('/properties/{id}/media/{mediaId}',    [PropertyMediaController::class, 'delete']);
});

Route::get('/users/{id}', [UserController::class, 'show']);
