<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KeyDate;
use Illuminate\Http\Request;

class KeyDateController extends Controller
{
    /**
     * Display a listing of the key dates.
     */
    public function index()
    {
        $keyDates = KeyDate::orderBy('date')->get();
        return view('admin.key-dates.index', compact('keyDates'));
    }

    /**
     * Store a newly created key date in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        KeyDate::create($request->all());

        return redirect()->route('admin.key-dates.index')->with('success', 'Key date added successfully.');
    }

    /**
     * Show the form for editing the specified key date.
     */
    public function edit(KeyDate $keyDate)
    {
        return view('admin.key-dates.edit', compact('keyDate'));
    }

    /**
     * Update the specified key date in storage.
     */
    public function update(Request $request, KeyDate $keyDate)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $keyDate->update($request->all());

        return redirect()->route('admin.key-dates.index')->with('success', 'Key date updated successfully.');
    }

    /**
     * Remove the specified key date from storage.
     */
    public function destroy(KeyDate $keyDate)
    {
        $keyDate->delete();
        
        return redirect()->route('admin.key-dates.index')->with('success', 'Key date deleted successfully.');
    }
}