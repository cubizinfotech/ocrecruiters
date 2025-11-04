<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LedgersController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\RecruiterController;
use App\Http\Controllers\Auth\SocialAuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/auth/{provider}', [SocialAuthController::class, 'redirect'])->name('social.redirect');
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback'])->name('social.callback');

Route::get('/recruiters', [RecruiterController::class, 'index'])->name('recruiters.index');

Route::get('/recruiters/{id}/{name}', [RecruiterController::class, 'show'])->name('recruiters.show');

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
->middleware('guest');

Route::get('/categories/ajax', [RecruiterController::class, 'ajaxCategorySearch'])
    ->name('categories.ajax');

Route::get('/location/ajax', [RecruiterController::class, 'ajaxLocationSearch'])
    ->name('location.ajax');

Route::get('/state/ajax', [RecruiterController::class, 'ajaxStateSearch'])
    ->name('state.ajax');

Route::get('/city/ajax', [RecruiterController::class, 'ajaxCitySearch'])
    ->name('city.ajax');

Route::get('/', function () {
    return redirect()->route('recruiters.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/get-cities', [ProfileController::class, 'getCities'])->name('get.cities');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/recruiter_edit', [RecruiterController::class, 'edit'])->name('recruiters.edit');
    Route::put('/recruiter_update', [RecruiterController::class, 'update'])->name('recruiters.update');

    Route::get('/resume_edit', [RecruiterController::class, 'resumeEdit'])->name('resume.edit');
    Route::post('/recruiters_store', [RecruiterController::class, 'storeOrUpdate'])->name('resume.save');

});
