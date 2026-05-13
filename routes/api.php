<?php

use App\Http\Controllers\Menu\MenuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1')->group(function () {

    Route::prefix('menus')->group(function () {

        Route::get('/', [MenuController::class, 'index']);

        Route::post('/', [MenuController::class, 'store']);
    });
});