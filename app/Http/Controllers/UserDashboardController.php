<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ClassSession;
use App\Models\Book;
use App\Models\Program;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\View\View; // Make sure to import the View class

class UserDashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $user = Auth::user();
        
        // Data that is always needed
        $latestEvents = Event::latest()->take(3)->get();
        $viewData = ['latestEvents' => $latestEvents];

        if ($user->is_approved) {
            // Data for the Student Dashboard
            $today = strtolower(Carbon::now()->format('l'));
            
            $dailySchedule = ClassSession::where('promotion_name', $user->promotion_name)
                ->where('group_name', $user->group_name)
                ->where('day_of_week', $today)
                ->orderBy('start_time')
                ->get();
            
            $now = Carbon::now()->format('H:i:s');
            
            $nextClass = ClassSession::where('promotion_name', $user->promotion_name)
                ->where('group_name', $user->group_name)
                ->where('day_of_week', $today)
                ->where('start_time', '>', $now)
                ->orderBy('start_time')
                ->first();
            
            $savedBooks = $user->books()->latest()->take(5)->get();

            // Add student-specific data to the view data array
            $viewData['dailySchedule'] = $dailySchedule;
            $viewData['nextClass'] = $nextClass;
            $viewData['savedBooks'] = $savedBooks;

        } else {
            // Data for the Normal User Dashboard
            $featuredPrograms = Program::take(2)->get();
            $featuredBooks = Book::inRandomOrder()->take(3)->get();

            // Add normal user-specific data to the view data array
            $viewData['featuredPrograms'] = $featuredPrograms;
            $viewData['featuredBooks'] = $featuredBooks;
        }

        // FIXED: Return the main 'dashboard' view and pass all the data
        // This view will then load the correct partial
        return view('dashboard', $viewData);
    }
}