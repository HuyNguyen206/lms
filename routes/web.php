<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth-lms', 'verified'])->name('dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth-lms:admin', 'verified'])->name('admin.dashboard');

Route::middleware(['auth-lms', 'verified', 'check-role:' . \App\Enums\Role::STUDENT->value])->prefix('student')->as('student.')->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Frontend\UserController::class, 'index'])->name('dashboard');
});

Route::middleware('auth-lms')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
