<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
 Route::post('/forgot-password', [AuthController::class, 'forgetPassword']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);

/*
|--------------------------------------------------------------------------
| Protected Routes (Sanctum)
|--------------------------------------------------------------------------
*/


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/update-password', [AuthController::class, 'updatePassword']);

    Route::get('/employees', [EmployeeController::class, 'index']);
    Route::post('/employees', [EmployeeController::class, 'store']);
    Route::get('/employees/{id}', [EmployeeController::class, 'show']);
    Route::put('/employees/{id}', [EmployeeController::class, 'update']);
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);
});