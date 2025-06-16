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
});

// Regular User Dashboard
Route::get('/dashboard', function () {
    $user = auth()->user();

    // Redirect admins away from the user dashboard
    if ($user && $user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    // Eager load the books for the authenticated user
    $savedBooks = $user->books()->latest()->get();

    return view('dashboard', compact('savedBooks'));
})->middleware(['auth', 'verified'])->name('dashboard');

// User Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';


// --- ADMIN ROUTES ---
// All routes in this group are protected by the 'auth' and 'admin' middleware.
// They are also prefixed with '/admin' in the URL and 'admin.' in the route name.
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::resource('library', LibraryController::class);

    // Academic Program Management Routes
    Route::resource('programs', ProgramController::class);
    Route::post('programs/{program}/courses', [ProgramController::class, 'storeCourse'])->name('programs.courses.store');

    // NEW: Course Management Routes
    Route::get('courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::put('courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // ... other profile routes

    // User Library Routes
    Route::get('/library', [BookController::class, 'index'])->name('library.index');
    Route::post('/library/{book}/save', [BookController::class, 'save'])->name('library.save');
    Route::delete('/library/{book}/unsave', [BookController::class, 'unsave'])->name('library.unsave');
});


Route::get('/api/books', [App\Http\Controllers\BookController::class, 'apiIndex'])->name('api.books.index');
Route::get('/api/book-types', [App\Http\Controllers\BookController::class, 'getBookTypes'])->name('api.books.types');


// Add this route
Route::get('language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');
