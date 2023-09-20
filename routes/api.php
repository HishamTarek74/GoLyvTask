<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\BusController;
use Illuminate\Support\Facades\Route;


//Authentication System
Route::prefix('auth')->as('auth.')->group(function () {
    Route::post('register', [AuthenticationController::class, 'register'])->name('register');
    Route::post('login', [AuthenticationController::class, 'login'])->name('login');
    Route:: as('user.')->middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout');
    });
});


//Bus System
Route::prefix('bus')->as('bus.')->group(function () {
    Route::get('/available-seats' , [BusController::class, 'getAvailableSeats']);
});
