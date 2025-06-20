<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LibraryController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\AcademicProgramController;
use App\Http\Controllers\PageController;
use App\Http\Middleware\RedirectIfAdmin;

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
    Route::get('/', function () {
        $savedBooks = auth()->user()->books()->latest()->get();
        return view('dashboard', compact('savedBooks'));
    })->name('dashboard');

    Route::get('/library', [BookController::class, 'index'])->name('library.index');
    Route::post('/library/{book}/save', [BookController::class, 'save'])->name('library.save');
    Route::delete('/library/{book}/unsave', [BookController::class, 'unsave'])->name('library.unsave');

    Route::get('/academic-programs', [AcademicProgramController::class, 'index'])->name('programs.index');
    Route::get('/academic-programs/{program}', [AcademicProgramController::class, 'show'])->name('programs.show');
});


// --- ADMIN ROUTES ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::resource('library', LibraryController::class);
    Route::resource('programs', ProgramController::class);
    Route::post('programs/{program}/courses', [ProgramController::class, 'storeCourse'])->name('programs.courses.store');
    Route::get('courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::put('courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
});


// --- API AND OTHER GLOBAL ROUTES ---
Route::get('/api/books', [BookController::class, 'apiIndex'])->name('api.books.index');
Route::get('/api/book-types', [BookController::class, 'getBookTypes'])->name('api.books.types');
Route::get('language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');
