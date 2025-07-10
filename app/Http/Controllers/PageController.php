<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSubmitted;
use App\Models\Book;
use App\Models\Event;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display the welcome page with necessary data.
     *
     * @return \Illuminate\View\View
     */
    public function welcome(): View
    {
        $programs = Program::all();
        $events = Event::latest()->take(3)->get();
        return view('welcome', compact('programs', 'events'));
    }

    /**
     * Display the contact us page.
     *
     * @return \Illuminate\View\View
     */
    public function contact(): View
    {
        return view('pages.contact');
    }

    /**
     * Handle the contact form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
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

    /**
     * Display the our story page.
     *
     * @return \Illuminate\View\View
     */
    public function ourStory(): View
    {
        return view('pages.our-story');
    }

    /**
     * Display the achievements page.
     *
     * @return \Illuminate\View\View
     */
    public function achievements(): View
    {
        return view('pages.achievements');
    }

    /**
     * Display the our professors page.
     *
     * @return \Illuminate\View\View
     */
    public function ourProfessors(): View
    {
        return view('pages.our-professors');
    }

    /**
     * Display the library page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
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

    /**
     * Display the academic programs page.
     *
     * @return \Illuminate\View\View
     */
    public function programs(): View
    {
        $programs = Program::all();
        return view('pages.programs', compact('programs'));
    }

    /**
     * Display the curriculum for a single public program.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\View\View
     */
    public function showProgram(Program $program): View
    {
        $coursesByYearAndSemester = $program->courses->groupBy(['year', 'semester']);
        return view('pages.program-show', compact('program', 'coursesByYearAndSemester'));
    }
    
    /**
     * Display the details for a single event.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\View\View
     */
    public function showEvent(Event $event): View
    {
        return view('pages.event-show', compact('event'));
    }
}