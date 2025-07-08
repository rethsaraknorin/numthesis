<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Program;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::with(['courses' => function ($query) {
            $query->orderBy('year')->orderBy('semester');
        }])->get();
        
        return view('admin.courses.index', compact('programs'));
    }

    /**
     * Store a newly created resource in storage using an inline form.
     */
    public function inlineStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'program_id' => 'required|exists:programs,id',
            'year' => 'required|integer|min:1|max:4',
            'semester' => 'required|integer|min:1|max:2',
            'credits' => 'nullable|integer',
            'hours' => 'nullable|integer',
        ]);

        $course = Course::create($validated);

        return response()->json($course);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programs = Program::all();
        return view('admin.courses.create', compact('programs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'program_id' => 'required|exists:programs,id',
            'year' => 'required|integer|min:1|max:4',
            'semester' => 'required|integer|min:1|max:2',
            'credits' => 'nullable|integer',
            'hours' => 'nullable|integer',
        ]);

        Course::create($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return redirect()->route('admin.courses.edit', $course);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $programs = Program::all();
        return view('admin.courses.edit', compact('course', 'programs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'program_id' => 'required|exists:programs,id',
            'year' => 'required|integer|min:1|max:4',
            'semester' => 'required|integer|min:1|max:2',
            'credits' => 'nullable|integer',
            'hours' => 'nullable|integer',
        ]);

        $course->update($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return back()->with('success', 'Course deleted successfully.');
    }
}