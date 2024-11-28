<?php

use App\Http\Controllers\Api\OrganisationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\StructureController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/auth')->group(function () {
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::controller(AuthenticatedSessionController::class)->group(function () {
        Route::post('/login', 'store');
        Route::post('/logout', 'destroy')->name('logout')->middleware(['auth:sanctum']);
    });
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('organisations', OrganisationController::class);
    Route::apiResource('structures',    StructureController::class)->only(['store']);
});
