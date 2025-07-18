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
    Route::patch('instructor-registration', [\App\Http\Controllers\Frontend\StudentController::class, 'instructorRegistrationPatch'])->name('instructor-registration.patch');

//    Route::get('profile', [\App\Http\Controllers\Frontend\ProfileController::class, 'index'])->name('profile');
//    Route::patch('profile', [\App\Http\Controllers\Frontend\ProfileController::class, 'update'])->name('profile.update');
//    Route::patch('profile/password', [\App\Http\Controllers\Frontend\ProfileController::class, 'updatePassword'])->name('profile.password-update');
});

Route::middleware(['auth-lms', 'verified', 'check-role:' . \App\Enums\Role::INSTRUCTOR->value])->prefix('instructor')->as('instructor.')->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Frontend\InstructorController::class, 'index'])->name('dashboard');
    Route::get('courses/create/{stage}', [\App\Http\Controllers\Frontend\Instructor\CourseController::class, 'create'])
        ->whereIn('stage', ['basic-info', 'course-content', 'finish', 'more-info'])->name('courses.create');
    Route::post('courses/create/{stage}', [\App\Http\Controllers\Frontend\Instructor\CourseController::class, 'store'])
        ->whereIn('stage', ['basic-info', 'course-content', 'finish', 'more-info'])->name('courses.store');

    Route::get('courses/edit/{course}/{stage?}', [\App\Http\Controllers\Frontend\Instructor\CourseController::class, 'edit'])
        ->whereIn('stage', ['basic-info', 'course-content', 'finish', 'more-info'])->name('courses.edit');
    Route::patch('courses/edit/{course}/{stage?}', [\App\Http\Controllers\Frontend\Instructor\CourseController::class, 'update'])
        ->whereIn('stage', ['basic-info', 'course-content', 'finish', 'more-info'])->name('courses.update');

    Route::resource('courses', \App\Http\Controllers\Frontend\Instructor\CourseController::class)->except(['create', 'store', 'edit', 'update']);
    Route::resource('courses.chapters', \App\Http\Controllers\Frontend\Instructor\ChapterController::class)->scoped();
    Route::resource('chapters.lessons', \App\Http\Controllers\Frontend\Instructor\LessonController::class)->scoped();

    Route::prefix('filemanager')->group(function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    Route::get('modals/view/{type}', [\App\Http\Controllers\Frontend\InstructorController::class, 'viewModal'])->name('view-modal');
});

Route::middleware(['auth-lms', 'verified'])->prefix('{role}')
    ->whereIn('role', [mb_strtolower(\App\Enums\Role::STUDENT->name), mb_strtolower(\App\Enums\Role::INSTRUCTOR->name)])
    ->group(function () {
    Route::get('profile', [\App\Http\Controllers\Frontend\ProfileController::class, 'index'])->name('profile');
    Route::patch('profile', [\App\Http\Controllers\Frontend\ProfileController::class, 'update'])->name('profile.update');
    Route::patch('profile/password', [\App\Http\Controllers\Frontend\ProfileController::class, 'updatePassword'])->name('profile.password-update');
});

Route::middleware('auth-lms')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
