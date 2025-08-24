<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductsController;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {

    Route::get('/sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);

    Route::prefix('auth')
        ->middleware(['web']) // penting untuk cookie/session
        ->group(function () {
            Route::post('/login', [AuthController::class, 'login']);
        });

    Route::middleware(['web', 'auth:sanctum'])->group(function () {
        Route::get('/auth/me', [AuthController::class, 'me']);
        Route::get('/products', [ProductsController::class, 'index']);
    });

});


Route::get('/', function () {
    return view('welcome');
});
