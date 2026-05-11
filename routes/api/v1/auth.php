<?php 

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\DeleteAccountController;
use App\Http\Controllers\Auth\ResendEmailVerificationController;
;

Route::prefix('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Public Routes
    |--------------------------------------------------------------------------
    */

    Route::post('/register', RegisterController::class);

    Route::post('/login', LoginController::class);

    /*
    |--------------------------------------------------------------------------
    | Protected Routes
    |--------------------------------------------------------------------------
    */

    Route::middleware('auth:sanctum')->group(function () {

        Route::post('/logout', LogoutController::class);

        /*
        |--------------------------------------------------------------------------
        | Email Verification
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/email/verify',
            VerifyEmailController::class
        );

        Route::post(
            '/email/resend',
            ResendEmailVerificationController::class
        );

        /*
        |--------------------------------------------------------------------------
        | Account Management
        |--------------------------------------------------------------------------
        */

        Route::delete(
            '/account',
            DeleteAccountController::class
        );

    });

});
