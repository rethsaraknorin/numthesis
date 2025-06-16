<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book; // 1. Add this line to import the Book model
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Fetch users and books to display their counts on the dashboard
        $users = User::where('role', 'user')->get();
        $books = Book::all(); // 2. Add this line to get all books

        // Pass both collections to the admin dashboard view
        return view('admin.index', compact('users', 'books')); // 3. Add 'books' here
    }
}