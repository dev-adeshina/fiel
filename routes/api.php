<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Menu\MenuController;
use App\Http\Controllers\Menu\MenuItemController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1')->group(function () {

    Route::prefix('menus')->group(function () {

        Route::get('/', [MenuController::class, 'index']);

        
    });

    Route::prefix('menu-items')->group(function () {

        Route::get('/', [MenuItemController::class, 'index']);

        Route::get('/{slug}', [MenuItemController::class, 'show']);

        
    });
});