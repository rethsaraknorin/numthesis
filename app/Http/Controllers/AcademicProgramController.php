<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AcademicProgramController extends Controller
{
    /**
     * Display a listing of all available academic programs.
     */
    public function index(): View
    {
        $programs = Program::all();
        return view('programs.index', compact('programs'));
    }

    /**
     * Display the detailed curriculum for a specific academic program.
     */
    public function show(Program $program): View
    {
        // Eager load the courses and group them by year, then by semester
        $program->load('courses');
        $coursesByYearAndSemester = $program->courses->groupBy(['year', 'semester']);

        return view('programs.show', compact('program', 'coursesByYearAndSemester'));
    }
}
