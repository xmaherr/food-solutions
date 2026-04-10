<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ConsultationController;

Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/lookup', [ServiceController::class, 'lookup']);
Route::get('/contacts', [ContactController::class, 'index']);
Route::post('/consultation', [ConsultationController::class, 'store']);
