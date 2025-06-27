<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class BookController extends Controller
{
    /**
     * Display the library page shell.
     */
    public function index(): View
    {
        // Get all unique book types to pass to the initial view for the filter dropdown.
        $bookTypes = $this->getAllBookTypes();
        return view('user.library.index', compact('bookTypes'));
    }

    /**
     * Handle the API request for books, now grouped by type.
     */
    public function apiIndex(Request $request): JsonResponse
    {
        $query = Book::query();

        // Eager load the 'users' relationship to check if the book is saved by the current user.
        $query->with(['users' => function ($query) {
            $query->where('user_id', Auth::id());
        }]);

        // Handle search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('author', 'like', '%' . $searchTerm . '%');
            });
        }
        
        // Fetch all matching books without pagination
        $books = $query->latest()->get();

        // Group the books by their types
        $groupedBooks = new Collection();

        foreach ($books as $book) {
            if (is_array($book->book_types)) {
                foreach ($book->book_types as $type) {
                    if (!$groupedBooks->has($type)) {
                        $groupedBooks[$type] = new Collection();
                    }
                    $groupedBooks[$type]->push($book);
                }
            }
        }
        
        // If a specific type is requested, filter the groups
        if ($request->filled('type')) {
             $filteredType = $request->input('type');
             $groupedBooks = $groupedBooks->filter(function ($books, $type) use ($filteredType) {
                return $type === $filteredType;
             });
        }

        return response()->json($groupedBooks);
    }
    
    /**
     * Get all unique book types from the database for the filter dropdown.
     */
    public function getBookTypes(): JsonResponse
    {
        return response()->json($this->getAllBookTypes());
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

    /**
     * Helper function to get all unique book types from the database.
     */
    private function getAllBookTypes(): array
    {
        $allTypesArrays = Book::whereNotNull('book_types')->pluck('book_types');

        return $allTypesArrays
            ->flatMap(fn ($types) => $types ?? [])
            ->filter()
            ->unique()
            ->sort()
            ->values()
            ->all();
    }
}