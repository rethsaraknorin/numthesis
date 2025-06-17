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
use App\Http\Middleware\RedirectIfAdmin;

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

// Welcome page
Route::get('/', function () {
    return view('welcome');
})->middleware(RedirectIfAdmin::class);

// Authentication routes (login, register, etc.)
require __DIR__ . '/auth.php';

// --- USER ROUTES ---
// All routes in this group are for authenticated, non-admin users.
Route::middleware(['auth', 'verified', 'user'])->group(function () {
    // Regular User Dashboard
    Route::get('/dashboard', function () {
        $savedBooks = auth()->user()->books()->latest()->get();
        return view('dashboard', compact('savedBooks'));
    })->name('dashboard');

    // User Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Library Routes
    Route::get('/library', [BookController::class, 'index'])->name('library.index');
    Route::post('/library/{book}/save', [BookController::class, 'save'])->name('library.save');
    Route::delete('/library/{book}/unsave', [BookController::class, 'unsave'])->name('library.unsave');

    // User-facing Academic Program Routes
    Route::get('/academic-programs', [AcademicProgramController::class, 'index'])->name('programs.index');
    Route::get('/academic-programs/{program}', [AcademicProgramController::class, 'show'])->name('programs.show');
});


// --- ADMIN ROUTES ---
// All routes in this group are for authenticated administrators only.
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
