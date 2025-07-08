<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ClassSession;
use App\Models\Book;
use App\Models\Program;
use App\Models\Event;
use Carbon\Carbon;
class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $latestEvents = Event::latest()->take(3)->get();
        if ($user->is_approved) {
            $today = strtolower(Carbon::now()->format('l'));
            // CORRECTED: Use promotion_name and group_name to query
            $dailySchedule = ClassSession::where('promotion_name', $user->promotion_name)
                ->where('group_name', $user->group_name)
                ->where('day_of_week', $today)
                ->orderBy('start_time')
                ->get();
            $now = Carbon::now()->format('H:i:s');
            // CORRECTED: Use promotion_name and group_name to query
            $nextClass = ClassSession::where('promotion_name', $user->promotion_name)
                ->where('group_name', $user->group_name)
                ->where('day_of_week', $today)
                ->where('start_time', '>', $now)
                ->orderBy('start_time')
                ->first();
            $savedBooks = $user->books()->latest()->take(5)->get();
            return view('dashboard.partials.student-dashboard', compact('dailySchedule', 'nextClass', 'savedBooks', 'latestEvents'));
        } else {
            $featuredPrograms = Program::take(3)->get();
            $featuredBooks = Book::inRandomOrder()->take(5)->get();
            return view('dashboard.partials.normal-dashboard', compact('featuredPrograms', 'featuredBooks', 'latestEvents'));
        }
    }
}