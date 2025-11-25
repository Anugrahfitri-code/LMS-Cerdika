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
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CertificateController;

// Rute AJAX Filter Homepage
Route::get('/courses/filter', [HomeController::class, 'filter'])->name('courses.filter');

Route::get('/', [HomeController::class, 'index'])->name('homepage');

// Rute Detail Kursus (Publik)
Route::get('/course/{course}', [HomeController::class, 'show'])->name('public.course.show');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/success-stories', [HomeController::class, 'stories'])->name('stories'); 

Route::get('/catalog', [HomeController::class, 'catalog'])->name('course.catalog');

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

    
        
    // Rute untuk menampilkan halaman belajar
    Route::get('/courses/{course}/lesson/{content}', [LessonController::class, 'show'])
        ->name('courses.lesson.show');

    // Rute untuk tombol "Mark as Done"
    Route::post('/lesson/{content}/complete', [ProgressController::class, 'store'])
        ->name('lesson.complete');

    Route::get('/courses/{course}/student-progress', [CourseController::class, 'studentProgress'])
         ->name('courses.student.progress'); 
         
    // Rute untuk menampilkan daftar thread & membuat thread baru
    Route::resource('courses.threads', ThreadController::class)->only([
        'index', 'create', 'store', 'show', 'destroy'
    ]);

    // Rute untuk membalas (membuat post) di dalam thread
    Route::post('/threads/{thread}/posts', [PostController::class, 'store'])
         ->name('threads.posts.store');

    // Rute untuk menghapus balasan (post)
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])
         ->name('posts.destroy');     

    Route::get('/courses/{course}/certificate', [CertificateController::class, 'generate'])
             ->name('courses.certificate'); 
             
    // Route khusus untuk hapus avatar
    Route::delete('/profile/avatar', [ProfileController::class, 'destroyAvatar'])->name('profile.avatar.destroy');         
});

require __DIR__.'/auth.php';