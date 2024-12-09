<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/receive-message', [\App\Http\Controllers\Api\MessageController::class, 'index']);
Route::get('/timer', [\App\Http\Controllers\Api\MessageController::class, 'timer']);
Route::get('/payment-status', [\App\Http\Controllers\Api\MessageController::class, 'paymentStatus']);
Route::post('/request-status', [\App\Http\Controllers\Api\MessageController::class, 'reuestStatus']);
