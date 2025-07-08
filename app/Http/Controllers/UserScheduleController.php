<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ClassSession;

class UserScheduleController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user->is_approved) {
            return redirect()->route('dashboard')->with('error', 'You must be an approved student to view schedules.');
        }

        // CORRECTED: Use 'promotion' and 'group' from the user model
        $schedule = ClassSession::where('promotion', $user->promotion)
            ->where('group', $user->group)
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get()
            ->groupBy('day_of_week');

        return view('user.schedule.index', compact('schedule'));
    }
}