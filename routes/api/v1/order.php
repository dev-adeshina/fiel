<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Order\CheckoutController;
use App\Http\Controllers\Order\OrderController;



Route::middleware(['auth:sanctum','verified',])->group(function () {

    Route::prefix('checkout')->group(function () {
         Route::post('/', CheckoutController::class);
    });


    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index']);

        Route::get('/{order}', [OrderController::class, 'show']);
    });

    
});

