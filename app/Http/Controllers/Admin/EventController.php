<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        // Eager load the 'user' relationship to show who uploaded the event
        $events = Event::with('user')->latest()->get();
        return view('admin.events.index', compact('events')); // View path will be updated next
    }

    public function create()
    {
        return view('admin.events.create'); // View path will be updated next
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');
        }

        Event::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'image_path' => $path,
            'user_id' => Auth::id(), // Assign the current admin's ID
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }
    
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event')); // View path will be updated next
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $event->image_path;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');
        }

        $event->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'image_path' => $path,
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }
}