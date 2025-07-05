<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSubmitted;
use App\Models\Book;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Illuminate\Support\Collection;

class PageController extends Controller
{
    /**
     * Display the contact us page.
     */
    public function contact(): View
    {
        return view('pages.contact');
    }

    /**
     * Handle the contact form submission.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Mail::to('sawen0254@gmail.com')->send(new ContactFormSubmitted($validated));

        return back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }

    public function ourStory(): View
    {
        return view('pages.our-story');
    }

    public function achievements(): View
    {
        return view('pages.achievements');
    }
    
    public function ourProfessors(): View
    {
        return view('pages.our-professors');
    }

    public function library(Request $request): View
    {
        $bookTypes = Book::whereNotNull('book_types')->pluck('book_types')->flatten()->unique()->sort()->values()->all();
        
        $query = Book::query();

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('author', 'like', "%{$searchTerm}%");
        }

        if ($request->filled('type')) {
            $type = $request->input('type');
            $query->whereJsonContains('book_types', $type);
        }
        
        $books = $query->latest()->get();
        
        $groupedBooks = new Collection();
        foreach ($books as $book) {
            foreach ((array)$book->book_types as $type) {
                if (!$groupedBooks->has($type)) {
                    $groupedBooks[$type] = new Collection();
                }
                $groupedBooks[$type]->push($book);
            }
        }
        
        return view('pages.library', compact('groupedBooks', 'bookTypes'));
    }

    public function programs(): View
    {
        $programs = Program::all();
        return view('pages.programs', compact('programs'));
    }
}