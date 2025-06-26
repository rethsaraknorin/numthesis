<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\ClassSession;

class UserScheduleController extends Controller
{
    /**
     * Display the personal schedule for the authenticated student.
     */
    public function index(): View
    {
        $user = Auth::user();

        // THIS IS THE CORRECTED QUERY
        // It now groups the sessions correctly so the view can display them.
        $schedules = ClassSession::where('promotion_name', $user->promotion_name)
            ->where('group_name', $user->group_name)
            ->with('course')
            ->get()
            ->groupBy(['year', 'semester', 'day_of_week', 'shift']); // Correct multi-level grouping

        return view('user.schedule.index', compact('schedules'));
    }
}