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
        // UPDATED: Changed 'programs.index' to 'user.programs.index'
        return view('user.programs.index', compact('programs'));
    }

    /**
     * Display the detailed curriculum for a specific academic program.
     */
    public function show(Program $program): View
    {
        $program->load('courses');
        $coursesByYearAndSemester = $program->courses->groupBy(['year', 'semester']);

        // UPDATED: Changed 'programs.show' to 'user.programs.show'
        return view('user.programs.show', compact('program', 'coursesByYearAndSemester'));
    }
}