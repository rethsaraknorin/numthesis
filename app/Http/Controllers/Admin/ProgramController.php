<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Course;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::withCount('courses')->get();
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.programs.create');
    }

    public function store(Request $request)
    {
        // UPDATED: Added validation for price fields
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:20|unique:programs,code',
            'description' => 'nullable|string',
            'price_per_year' => 'nullable|numeric|min:0',
            'price_per_semester' => 'nullable|numeric|min:0',
        ]);

        Program::create($validated);

        return redirect()->route('admin.programs.index')->with('success', 'Academic program created successfully.');
    }

    public function show(Program $program)
    {
        $program->load('courses');
        return view('admin.programs.show', compact('program'));
    }

    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        // UPDATED: Added validation for price fields
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:20|unique:programs,code,' . $program->id,
            'description' => 'nullable|string',
            'price_per_year' => 'nullable|numeric|min:0',
            'price_per_semester' => 'nullable|numeric|min:0',
        ]);

        $program->update($validated);

        return redirect()->route('admin.programs.index')->with('success', 'Academic program updated successfully.');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('admin.programs.index')->with('success', 'Academic program deleted successfully.');
    }

    public function storeCourse(Request $request, Program $program)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'year' => 'required|integer|min:1|max:4',
            'semester' => 'required|integer|min:1|max:2',
        ]);

        $program->courses()->create($validated);

        return back()
            ->with('success', 'Course added successfully.')
            ->with('active_year', $validated['year']);
    }

    public function destroyCourse(Course $course)
    {
        $course->delete();
        return back()->with('success', 'Course deleted successfully.');
    }
}
