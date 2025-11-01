<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RecruitersController;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    });

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');
        Route::get('/locations/create', [LocationController::class, 'create'])->name('locations.create');
        Route::post('/locations/store', [LocationController::class, 'store'])->name('locations.store');
        Route::get('/locations/{id}/edit', [LocationController::class, 'edit'])->name('locations.edit');
        Route::put('/locations/{id}', [LocationController::class, 'update'])->name('locations.update');
        Route::delete('/locations/{id}', [LocationController::class, 'destroy'])->name('locations.destroy');

        // Category CRUD
        Route::resource('/categories', CategoryController::class);
        Route::resource('/recruiters', RecruitersController::class);
        Route::get('/recruiters', [RecruitersController::class, 'index'])->name('recruiters.index');
    });
});
