<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ConsultationController;
use App\Http\Controllers\Api\HomeController;

Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/lookup', [ServiceController::class, 'lookup']);
Route::get('/contacts', [ContactController::class, 'index']);
Route::post('/consultation', [ConsultationController::class, 'store']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/statistics', [\App\Http\Controllers\Api\StatisticController::class, 'index']);
