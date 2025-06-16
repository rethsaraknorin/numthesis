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
        return view('admin.library.create');
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
            'picture' => ['nullable', 'image', 'max:2048'], // Max 2MB
            'book_types' => ['nullable', 'string'], // Validate the incoming book types
        ]);

        // Handle file upload
        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('books', 'public');
            $validated['picture'] = $path;
        }

        // --- MODIFICATION START ---
        // Process the comma-separated string into a clean array
        if (!empty($validated['book_types'])) {
            // Explode the string by comma, trim whitespace from each item, and remove any empty items
            $validated['book_types'] = array_filter(array_map('trim', explode(',', $validated['book_types'])));
        } else {
            // If the field is empty or null, store an empty array
            $validated['book_types'] = [];
        }
        // --- MODIFICATION END ---

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
        return view('admin.library.edit', ['book' => $library]);
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
            'picture' => ['nullable', 'image', 'max:2048'], // Max 2MB
            'book_types' => ['nullable', 'string'], // Validate the incoming book types
        ]);

        // Handle file upload
        if ($request->hasFile('picture')) {
            // Delete old picture if exists
            if ($library->picture) {
                Storage::disk('public')->delete($library->picture);
            }
            $path = $request->file('picture')->store('books', 'public');
            $validated['picture'] = $path;
        }

        // --- MODIFICATION START ---
        // Process the comma-separated string into a clean array
        if (!empty($validated['book_types'])) {
            // Explode the string by comma, trim whitespace from each item, and remove any empty items
            $validated['book_types'] = array_filter(array_map('trim', explode(',', $validated['book_types'])));
        } else {
            // If the field is empty or null, store an empty array
            $validated['book_types'] = [];
        }
        // --- MODIFICATION END ---

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
        // Delete the book's picture if it exists
        if ($library->picture) {
            Storage::disk('public')->delete($library->picture);
        }

        $library->delete();

        return redirect()
            ->route('admin.library.index')
            ->with('success', 'Book deleted successfully.');
    }
}