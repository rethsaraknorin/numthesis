<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LibraryController extends Controller
{
    /**
     * Display a listing of the books.
     */
    public function index()
    {
        $books = Book::latest()->paginate(10);
        return view('admin.library.index', compact('books'));
    }

    /**
     * Show the form for creating a new book.
     */
    public function create()
    {
        // Get all unique book types to populate the dropdown
        $bookTypes = $this->getAllBookTypes();
        return view('admin.library.create', compact('bookTypes'));
    }

    /**
     * Store a newly created book in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'publisher' => ['nullable', 'string', 'max:255'],
            'publication_year' => ['required', 'integer', 'min:1800', 'max:' . date('Y')],
            'description' => ['nullable', 'string'],
            'book_link' => ['nullable', 'url', 'max:255'],
            'picture' => ['nullable', 'image', 'max:2048'],
            'book_types' => ['nullable', 'array'], // Validate as an array
            'book_types.*' => ['string', 'max:255'], // Validate each item in the array
        ]);

        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('books', 'public');
            $validated['picture'] = $path;
        }

        // The Book model will automatically cast the array to JSON
        Book::create($validated);

        return redirect()
            ->route('admin.library.index')
            ->with('success', 'Book added successfully.');
    }

    /**
     * Show the form for editing the specified book.
     */
    public function edit(Book $library)
    {
        // Get all unique book types to populate the dropdown
        $bookTypes = $this->getAllBookTypes();
        return view('admin.library.edit', ['book' => $library, 'bookTypes' => $bookTypes]);
    }

    /**
     * Update the specified book in storage.
     */
    public function update(Request $request, Book $library)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'publisher' => ['nullable', 'string', 'max:255'],
            'publication_year' => ['required', 'integer', 'min:1800', 'max:' . date('Y')],
            'description' => ['nullable', 'string'],
            'book_link' => ['nullable', 'url', 'max:255'],
            'picture' => ['nullable', 'image', 'max:2048'],
            'book_types' => ['nullable', 'array'], // Validate as an array
            'book_types.*' => ['string', 'max:255'], // Validate each item in the array
        ]);

        if ($request->hasFile('picture')) {
            if ($library->picture) {
                Storage::disk('public')->delete($library->picture);
            }
            $path = $request->file('picture')->store('books', 'public');
            $validated['picture'] = $path;
        }

        // If 'book_types' is not present, set it to an empty array to clear existing types
        $validated['book_types'] = $request->input('book_types', []);

        $library->update($validated);

        return redirect()
            ->route('admin.library.index')
            ->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified book from storage.
     */
    public function destroy(Book $library)
    {
        if ($library->picture) {
            Storage::disk('public')->delete($library->picture);
        }
        $library->delete();

        return redirect()
            ->route('admin.library.index')
            ->with('success', 'Book deleted successfully.');
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
