<?php

namespace App\Http\Controllers;

use App\Models\ClassSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserScheduleController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $schedules = collect(); // Default to an empty collection

        if ($user->is_approved && $user->promotion_name && $user->group_name) {
            $sessions = ClassSession::where('promotion_name', $user->promotion_name)
                ->where('group_name', $user->group_name)
                ->with('course') // Eager load the course relationship
                ->get();
            
            // Define the correct order for days and shifts
            $dayOrder = array_flip(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']);
            $shiftOrder = array_flip(['Morning', 'Afternoon', 'Night', 'Weekend']);

            // Group the sessions correctly
            $schedules = $sessions->groupBy(['year', 'semester'])->sortKeys()
                ->map(function ($semesters) use ($dayOrder, $shiftOrder) {
                    return $semesters->sortKeys()->map(function ($sessions) use ($dayOrder, $shiftOrder) {
                        return $sessions->groupBy('day_of_week')
                            ->sortBy(function ($_, $day) use ($dayOrder) {
                                return $dayOrder[$day] ?? 99;
                            })
                            ->map(function ($daySessions) use ($shiftOrder) {
                                return $daySessions->groupBy('shift')
                                    ->sortBy(function ($_, $shift) use ($shiftOrder) {
                                        return $shiftOrder[$shift] ?? 99;
                                    });
                            });
                    });
                });
        }
        
        // Pass the correctly named and structured $schedules variable to the view
        return view('user.schedule.index', compact('schedules'));
    }
}