<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ConsultationController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\StatisticController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FoodCostController;

use App\Http\Controllers\Api\ServiceReviewController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/account', [AuthController::class, 'show']);
    Route::put('/account', [AuthController::class, 'update']);
    Route::delete('/account', [AuthController::class, 'destroy']);

});
Route::post('/consultation', [ConsultationController::class, 'store']);
Route::post('/tools/food-cost-calculator', [FoodCostController::class, 'calculate']);
Route::post('/services/reviews', [ServiceReviewController::class, 'store']);
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/lookup', [ServiceController::class, 'lookup']);
Route::get('/contacts', [ContactController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/statistics', [StatisticController::class, 'index']);
