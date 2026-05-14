<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Cart\CartController;

Route::middleware(['auth:sanctum', 'verified',])->prefix('cart')->group(function () {

    Route::get('/', [CartController::class, 'index']);

    Route::post('/', [CartController::class, 'store']);
    Route::patch('/items/{cartItem}', [CartController::class, 'update']);
    Route::delete('/items/{cartItem}', [CartController::class, 'destroy']);
    Route::delete('/', [CartController::class, 'clear']);
});