<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductsController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')
    ->middleware(['web']) // penting untuk cookie/session
    ->group(function () {
        Route::post('/login', [AuthController::class, 'login']);
    });

Route::get('/products', [ProductsController::class, 'index']);

Route::get('/', function () {
    return view('welcome');
});
