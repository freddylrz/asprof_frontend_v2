<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/receive-message', [\App\Http\Controllers\Api\MessageController::class, 'index']);
Route::get('/timer', [\App\Http\Controllers\Api\MessageController::class, 'timer']);
