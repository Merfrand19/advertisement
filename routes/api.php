<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\VideoController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\UserController;

Route::apiResource('videos', VideoController::class);
Route::apiResource('articles', ArticleController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/users/me', [UserController::class, 'show']);
    Route::apiResource('users', UserController::class)->except(['show']);
});
