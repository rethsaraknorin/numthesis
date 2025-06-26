<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ClassSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
     * Display the detailed curriculum and (if applicable) schedule for a program.
     */
    public function show(Program $program): View
    {
        $user = Auth::user();

        // --- Data for Curriculum (always needed) ---
        $coursesByYearAndSemester = $program->courses->groupBy(['year', 'semester']);

        // --- Initialize variables ---
        $schedules = collect();
        $is_current_student = false;

        // Check if the user is a verified student
        if ($user && $user->is_approved) {
            $is_current_student = true;
            // Fetch only the schedule for the student's specific promotion and group
            $schedules = ClassSession::where('program_id', $program->id)
                ->where('promotion_name', $user->promotion_name)
                ->where('group_name', $user->group_name)
                ->with('course')
                ->get()
                ->groupBy(['year', 'semester']);
        }

        return view('user.programs.show', compact(
            'program',
            'coursesByYearAndSemester',
            'schedules',
            'is_current_student' // This variable is now always passed to the view
        ));
    }
}