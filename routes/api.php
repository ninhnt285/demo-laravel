<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Authorization
Route::controller(\App\Http\Controllers\Api\AuthController::class)->group(function() {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group(function () {
    // Demo
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    // Blogs
    Route::apiResource('blogs', \App\Http\Controllers\Api\BlogController::class)->except(['index', 'show']);
});

Route::apiResource('blogs', \App\Http\Controllers\Api\BlogController::class)->only(['index', 'show']);
