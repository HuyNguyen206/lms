<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth-lms:admin');

Route::name('admin.')->group(function () {
    Route::middleware('guest-lms:admin')->group(function () {
        Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');

        Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
            ->name('password.request');

        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
            ->name('password.email');

        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
            ->name('password.reset');

        Route::post('reset-password', [NewPasswordController::class, 'store'])
            ->name('password.store');
    });

    Route::middleware('auth-lms:admin')->group(function () {
        Route::get('dashboard', [\App\Http\Controllers\Admin\AdminController::class, 'index'])
            ->middleware(['auth-lms:admin', 'verified'])
            ->name('dashboard');

        Route::get('verify-email', EmailVerificationPromptController::class)
            ->name('verification.notice');

        Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');

        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware('throttle:6,1')
            ->name('verification.send');

        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
            ->name('password.confirm');

        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

        Route::put('password', [PasswordController::class, 'update'])->name('password.update');

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');

        Route::get('instructor-requests', [\App\Http\Controllers\Admin\AdminController::class, 'instructorRequests'])->name('instructor.requests');
        Route::patch('instructor-requests/{user?}', [\App\Http\Controllers\Admin\AdminController::class, 'updateStatus'])->name('instructor.update-status');
        Route::get('instructor-requests/download-document/{user?}', [\App\Http\Controllers\Admin\AdminController::class, 'downloadDocument'])->name('instructor.download-document');

        Route::prefix('courses')->as('courses.')->group(function () {
            Route::resource('languages', \App\Http\Controllers\Admin\Course\LanguageController::class);
            Route::resource('levels', \App\Http\Controllers\Admin\Course\LevelController::class);
            Route::resource('categories', \App\Http\Controllers\Admin\Course\CategoryController::class);
        });
    });
});

