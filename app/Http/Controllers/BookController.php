<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BookController extends Controller
{
    /**
     * Display a listing of all books for the user to browse.
     */
    public function index(): View
    {
        $books = Book::latest()->paginate(12); // Paginate for better performance
        return view('library.index', compact('books'));
    }

    /**
     * Save a book to the authenticated user's list.
     */
    public function save(Request $request, Book $book): RedirectResponse
    {
        $user = Auth::user();
        $user->books()->syncWithoutDetaching([$book->id]); // Use syncWithoutDetaching to avoid duplicates

        return back()->with('success', 'Book saved to your dashboard!');
    }

    /**
     * Remove a book from the authenticated user's list.
     */
    public function unsave(Request $request, Book $book): RedirectResponse
    {
        $user = Auth::user();
        $user->books()->detach($book->id);

        return back()->with('success', 'Book removed from your dashboard.');
    }
}