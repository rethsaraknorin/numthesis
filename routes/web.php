<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LibraryController;

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
    // Redirect admins away from the user dashboard
    if (auth()->user() && auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
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

    // Admin Dashboard (Summary Page)
    // URL: /admin/dashboard
    // Name: admin.dashboard
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // Users Management Page
    // URL: /admin/users
    // Name: admin.users.index
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // Route to handle user deletion
    // URL: /admin/users/{user} (e.g., /admin/users/5)
    // Name: admin.users.destroy
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Library Management Routes
    Route::resource('library', LibraryController::class);
});
