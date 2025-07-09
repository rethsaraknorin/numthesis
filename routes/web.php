<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LibraryController as AdminLibraryController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\AcademicProgramController;
use App\Http\Controllers\PageController;
use App\Http\Middleware\RedirectIfAdmin;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\UserScheduleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Welcome page
Route::get('/', function () {
    return view('welcome');
})->middleware(RedirectIfAdmin::class);

// Static Page Routes
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'store'])->name('contact.store');
Route::get('/about/our-story', [PageController::class, 'ourStory'])->name('about.our-story');
Route::get('/about/achievements', [PageController::class, 'achievements'])->name('about.achievements');
Route::get('/about/our-professors', [PageController::class, 'ourProfessors'])->name('about.our-professors');
Route::get('/library', [PageController::class, 'library'])->name('page.library');
Route::get('/academic-programs', [PageController::class, 'programs'])->name('page.programs');


// Authentication routes (login, register, etc.)
require __DIR__ . '/auth.php';

// --- SHARED AUTHENTICATED ROUTES ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// --- USER ROUTES ---
Route::middleware(['auth', 'verified', 'user'])->prefix('dashboard')->group(function () {
    Route::get('/', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/my-schedule', [UserScheduleController::class, 'index'])->name('schedule.my');
    Route::get('/library', [BookController::class, 'index'])->name('library.index');
    Route::post('/library/{book}/save', [BookController::class, 'save'])->name('library.save');
    Route::delete('/library/{book}/unsave', [BookController::class, 'unsave'])->name('library.unsave');
    Route::get('/academic-programs', [AcademicProgramController::class, 'index'])->name('programs.index');
    Route::get('/academic-programs/{program}', [AcademicProgramController::class, 'show'])->name('programs.show');
});


// --- ADMIN ROUTES ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // User Management Routes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/all', [UserController::class, 'allUsers'])->name('users.all');
    Route::get('/users/requests', [UserController::class, 'requests'])->name('users.requests');
    Route::get('/users/students', [UserController::class, 'students'])->name('users.students');
    Route::post('/users/{user}/approve', [UserController::class, 'approve'])->name('users.approve');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Library Routes
    Route::resource('library', AdminLibraryController::class);

    // Event Routes
    Route::resource('events', \App\Http\Controllers\Admin\EventController::class);

    // Program and Course Routes
    Route::resource('programs', AdminProgramController::class);
    Route::post('courses/inline-store', [CourseController::class, 'inlineStore'])->name('courses.inlineStore');
    Route::resource('courses', CourseController::class);

    // Notification Routes
    Route::post('/notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');

    // Schedule Routes
    Route::get('schedules', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::get('schedules/{program}', [ScheduleController::class, 'selectYear'])->name('schedules.selectYear');
    Route::get('schedules/{program}/{year}', [ScheduleController::class, 'selectSemester'])->name('schedules.selectSemester');
    Route::get('schedules/{program}/{year}/{semester}', [ScheduleController::class, 'manageBySemester'])->name('schedules.manage');
    Route::post('schedules/{program}/{year}/{semester}', [ScheduleController::class, 'store'])->name('schedules.store');

    // All these routes correctly use '{session}' for Route Model Binding
    Route::get('schedules/session/{session}/edit', [ScheduleController::class, 'edit'])->name('schedules.edit');
    Route::put('schedules/session/{session}', [ScheduleController::class, 'update'])->name('schedules.update');
    Route::delete('schedules/session/{session}', [ScheduleController::class, 'destroy'])->name('schedules.destroy');
});


// --- API AND OTHER GLOBAL ROUTES ---
Route::get('/api/books', [BookController::class, 'apiIndex'])->name('api.books.index');
Route::get('/api/book-types', [BookController::class, 'getBookTypes'])->name('api.books.types');
Route::get('language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');