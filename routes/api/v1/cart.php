<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Cart\CartController;

Route::middleware([
    'auth:sanctum',
    'verified',
])

->prefix('cart')

->group(function () {

    Route::get(
        '/',
        [CartController::class, 'index']
    );

    Route::post(
        '/',
        [CartController::class, 'store']
    );
});