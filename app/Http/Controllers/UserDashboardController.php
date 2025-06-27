<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\ClassSession;
use App\Models\KeyDate;
use App\Models\Program;
use App\Models\Book;
use Carbon\Carbon;

class UserDashboardController extends Controller
{
    /**
     * Display the appropriate dashboard based on user's approval status.
     */
    public function index(): View
    {
        $user = Auth::user();
        $savedBooks = $user->books()->latest()->get();

        // Check if the user is an approved student
        if ($user && $user->is_approved) {

            // --- Logic for CURRENT, APPROVED STUDENTS ---
            $now = Carbon::now();
            $todayName = $now->format('l');

            // Fetch today's schedule for the user's specific group
            $todaysSchedule = ClassSession::where('promotion_name', $user->promotion_name)
                ->where('group_name', $user->group_name)
                ->where('day_of_week', $todayName)
                ->with('course')
                ->orderBy('start_time')
                ->get();
            
            // Find the next class for today by filtering sessions that start after the current time
            $nextClass = $todaysSchedule->first(function ($session) use ($now) {
                return Carbon::parse($session->start_time)->isAfter($now);
            });
            
            // Fetch upcoming key dates
            $keyDates = KeyDate::where('date', '>=', now())->orderBy('date')->take(4)->get();

            return view('dashboard', [
                'is_current_student' => true,
                'todaysSchedule' => $todaysSchedule,
                'nextClass' => $nextClass, // Pass the next class to the view
                'savedBooks' => $savedBooks,
                'keyDates' => $keyDates,
            ]);

        } else {

            // --- Logic for PROSPECTIVE / UNAPPROVED STUDENTS ---
            $keyDates = KeyDate::where('date', '>=', now())->orderBy('date')->take(4)->get();
            $programs = Program::all();
            $featuredBooks = Book::latest()->take(4)->get();

            return view('dashboard', [
                'is_current_student' => false,
                'keyDates' => $keyDates,
                'programs' => $programs,
                'featuredBooks' => $featuredBooks,
                'savedBooks' => $savedBooks,
            ]);
        }
    }
}
