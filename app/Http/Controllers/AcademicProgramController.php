<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ClassSession;
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
        return view('user.programs.index', compact('programs'));
    }

    /**
     * Display the detailed curriculum and schedules for a specific academic program.
     */
    public function show(Program $program): View
    {
        // Load the courses and group them for the curriculum view
        $coursesByYearAndSemester = $program->courses->groupBy(['year', 'semester']);

        // --- NEW LOGIC TO GET SCHEDULES ---
        
        // Fetch all class sessions for this program
        $sessions = ClassSession::where('program_id', $program->id)
            ->with('course') // Eager load course details
            ->get();
            
        // Get all unique promotions and groups for this program to use as filters
        $promotions = $sessions->pluck('promotion_name')->unique()->sort();
        $groups = $sessions->pluck('group_name')->unique()->sort();

        // Group sessions for easy access in the view
        $schedules = $sessions->groupBy(['promotion_name', 'group_name']);

        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $shifts = ['Morning', 'Afternoon', 'Night', 'Weekend'];
        // --- END NEW LOGIC ---

        return view('user.programs.show', compact(
            'program', 
            'coursesByYearAndSemester',
            'schedules', // Pass schedules to the view
            'promotions', // Pass promotions to the view
            'groups', // Pass groups to the view
            'days',
            'shifts'
        ));
    }
}