<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyMetricsController;
use App\Http\Controllers\PropertyImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    
    // Properties
    Route::apiResource('properties', PropertyController::class);
    
    // Property Metrics
    Route::post('/properties/{property}/metrics', [PropertyMetricsController::class, 'store']);
    Route::get('/properties/{property}/roi', [PropertyMetricsController::class, 'calculateROI']);
    Route::get('/dashboard', [PropertyMetricsController::class, 'dashboard']);
    
    // Property Images
    Route::post('/properties/{property}/images', [PropertyImageController::class, 'upload']);
    Route::delete('/properties/{property}/images/{image}', [PropertyImageController::class, 'delete']);
});
