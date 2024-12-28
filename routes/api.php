<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CountryController;

// Generate Token route
Route::post('/tokens/create', [AuthController::class, 'login']);
Route::post('users', [UserController::class, 'store']);

// User CRUD routes
Route::get('users', [UserController::class, 'index'])->middleware('auth:sanctum');
Route::get('users/{user}', [UserController::class, 'show'])->middleware('auth:sanctum');
Route::put('users/{user}', [UserController::class, 'update'])->middleware('auth:sanctum');
Route::delete('users/{user}', [UserController::class, 'destroy'])->middleware('auth:sanctum');

// Country CRUD routes
Route::middleware('auth:sanctum')->resource('countries', CountryController::class);
