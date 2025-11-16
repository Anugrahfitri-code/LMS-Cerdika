<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProgressController;

Route::get('/', [HomeController::class, 'index'])->name('homepage');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () { 
    
    // Rute Profile Bawaan
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute untuk Admin & Teacher
    Route::resource('courses', CourseController::class);
    Route::resource('courses.contents', ContentController::class)->shallow();

    // Grup khusus Admin 
    Route::middleware('role:admin')->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('users', UserManagementController::class);
    });

    // student
    Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'store'])
            ->middleware('role:student') 
            ->name('courses.enroll');

    Route::get('/catalog', [HomeController::class, 'catalog'])->name('course.catalog');
        
    // Rute untuk menampilkan halaman belajar
    Route::get('/courses/{course}/lesson/{content}', [LessonController::class, 'show'])
        ->name('courses.lesson.show');

    // Rute untuk tombol "Mark as Done"
    Route::post('/lesson/{content}/complete', [ProgressController::class, 'store'])
        ->name('lesson.complete');

    Route::get('/courses/{course}/student-progress', [CourseController::class, 'studentProgress'])
         ->name('courses.student.progress');    

});

require __DIR__.'/auth.php';