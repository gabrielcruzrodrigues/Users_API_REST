<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)
    ->middleware(['auth:sanctum'])
    ->group(function() 
    {
        Route::get('/users', 'index');
        Route::get('/users/{user}', 'show');
        Route::post('/users', 'store');
        Route::put('/users/{user}', 'update');
        Route::delete('/users/{user}', 'destroy');
    }
);

Route::controller(AuthController::class)->group(function() {
    Route::post('/login', 'login')->name('login');
    Route::post('/logout/{user}', 'logout')->name('logout')->middleware('auth:sanctum');
});

