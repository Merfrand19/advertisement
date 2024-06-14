<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\RetraitController;
use App\Http\Controllers\API\PortefeuilleController;

Route::apiResource('videos', VideoController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/users/me', [UserController::class, 'show']);


    Route::get("/portefeuille", [PortefeuilleController::class, "show"]);
    Route::patch("/portefeuille", [PortefeuilleController::class, "update"]);

    Route::post("/retrait", [RetraitController::class, "store"]);


    Route::apiResource('users', UserController::class)->except(['show']);
});
