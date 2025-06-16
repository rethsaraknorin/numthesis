<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    /**
     * Display the library page shell.
     */
    public function index(): View
    {
        return view('library.index');
    }

    /**
     * Handle the API request for books, with filtering and searching.
     */
    public function apiIndex(Request $request): JsonResponse
    {
        $query = Book::query();

        $query->with(['users' => function ($query) {
            $query->where('user_id', Auth::id());
        }]);

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('author', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($request->filled('type')) {
            $type = $request->input('type');
            $query->whereJsonContains('book_types', $type);
        }

        $books = $query->latest()->paginate(12)->withQueryString();

        return response()->json($books);
    }
    
    /**
     * NEW: Get all unique book types from the database for the filter dropdown.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBookTypes(): JsonResponse
    {
        // Pluck the 'book_types' column, which contains JSON arrays
        $allTypesArrays = Book::whereNotNull('book_types')->pluck('book_types');

        // Flatten the array of arrays into a single collection, get unique values,
        // filter out any null/empty values, sort them, and reset the keys.
        $uniqueTypes = $allTypesArrays
            ->flatMap(function ($types) {
                // Since the data is stored as a JSON string, decode it into a PHP array
                return json_decode($types, true) ?? [];
            })
            ->filter()
            ->unique()
            ->sort()
            ->values();

        return response()->json($uniqueTypes);
    }

    /**
     * Save a book to the authenticated user's list.
     */
    public function save(Request $request, Book $book): RedirectResponse
    {
        $user = Auth::user();
        $user->books()->syncWithoutDetaching([$book->id]);

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
