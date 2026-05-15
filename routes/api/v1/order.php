<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Order\CheckoutController;

Route::middleware(['auth:sanctum','verified',])->prefix('checkout')->group(function () {

    Route::post('/', CheckoutController::class);
});