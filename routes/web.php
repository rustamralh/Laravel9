<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::resource('home', HomeController::class)->only(['index']);

Route::prefix('auth')
    // ->middleware(['email.transform'])
    ->group(function () {
        Route::get('login', [LoginController::class, 'index'])->name('login');
        Route::post('login', [LoginController::class, 'store'])->name('login.store');

        Route::get('forgot-password', [ForgotPasswordController::class, 'index'])->name('forgot-password.index');
        Route::post('forgot-password', [ForgotPasswordController::class, 'store'])->name('forgot-password');

        Route::get('password/reset/{token}', [ResetPasswordController::class, 'index'])->name('password.reset');
        Route::post('password/reset', [ResetPasswordController::class, 'store'])->name('password.update');

        Route::get('register', [RegisterController::class, 'index'])->name('register.index');
        Route::post('register', [RegisterController::class, 'register'])->name('register.store');

        Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
        Route::get('email/verification-notification', [VerificationController::class, 'sendVerificationEmail'])->name('verification.send');
        Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verifyEmail'])->name('verification.verify');
    });

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('auth/logout', LogoutController::class, [
        'names' => [
            'index' => 'logout',
        ],
    ])->only(['index']);
});
