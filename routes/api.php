<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    return response()->json(['status' => 'ok'], 200);
});

Route::middleware(['auth:sanctum', 'can:create-user'])
    ->post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/orders', [OrderController::class, 'index']);
Route::middleware('auth:sanctum')->post('/orders', [OrderController::class, 'store']);
Route::middleware('auth:sanctum')->get('/orders/{id}', [OrderController::class, 'show']);
Route::middleware('auth:sanctum')->patch('/orders/{id}', [OrderController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/orders/{id}', [OrderController::class, 'destroy']);
