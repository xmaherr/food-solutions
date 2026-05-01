<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ConsultationController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HomeSectionController;

Route::get('/', function () {
    return redirect('/admin/login');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::resource('home-sections', HomeSectionController::class);
        Route::resource('services', ServiceController::class);
        Route::resource('contacts', ContactController::class);
        
        Route::get('consultations', [ConsultationController::class, 'index'])->name('consultations.index');
        Route::get('consultations/{consultation}', [ConsultationController::class, 'show'])->name('consultations.show');
        Route::delete('consultations/{consultation}', [ConsultationController::class, 'destroy'])->name('consultations.destroy');

        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [SettingController::class, 'store'])->name('settings.store');

        Route::resource('users', UserController::class);

        Route::get('statistics', [\App\Http\Controllers\Admin\StatisticController::class, 'index'])->name('statistics.index');
        Route::get('statistics/{statistic}/edit', [\App\Http\Controllers\Admin\StatisticController::class, 'edit'])->name('statistics.edit');
        Route::put('statistics/{statistic}', [\App\Http\Controllers\Admin\StatisticController::class, 'update'])->name('statistics.update');
    });
});
