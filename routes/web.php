<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\Frontend\FrontendController::class, 'index']);

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth-lms', 'verified'])->name('dashboard');

Route::middleware(['auth-lms', 'verified', 'check-role:' . \App\Enums\Role::STUDENT->value])->prefix('student')->as('student.')->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Frontend\StudentController::class, 'index'])->name('dashboard');
    Route::get('instructor-registration', [\App\Http\Controllers\Frontend\StudentController::class, 'instructorRegistration'])->name('instructor-registration');
});

Route::middleware(['auth-lms', 'verified', 'check-role:' . \App\Enums\Role::INSTRUCTOR->value])->prefix('instructor')->as('instructor.')->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Frontend\InstructorController::class, 'index'])->name('dashboard');
});

Route::middleware('auth-lms')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
