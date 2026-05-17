<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Reservation\ReservationController;

Route::middleware(['auth:sanctum', 'verified',])->group(function () {

    Route::get('/reservations', [ReservationController::class, 'index']);

    Route::post('/reservations', [ReservationController::class, 'store']);

    Route::get('/reservations/{reservation}', [ReservationController::class, 'show']);
});