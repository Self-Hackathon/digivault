<?php

use App\Http\Controllers\Api\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')
    ->middleware(['web']) // penting untuk cookie/session
    ->group(function () {
        Route::post('/login', [LoginController::class, 'authenticate']);
    });

Route::get('/', function () {
    return view('welcome');
});
