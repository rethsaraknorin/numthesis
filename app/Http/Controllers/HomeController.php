<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB; // Import DB facade

class HomeController extends Controller
{
    /**
     * Show the application admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Data for summary cards
        $users = User::where('role', 'user')->get();
        $books = Book::all();
        $programs = Program::all();
        $recentUsersCount = User::where('role', 'user')->where('created_at', '>=', Carbon::now()->subWeek())->count();
        $recentBooksCount = Book::where('created_at', '>=', Carbon::now()->subWeek())->count();

        // NEW: Data for "Recently Added" lists
        $latestUsers = User::where('role', 'user')->latest()->take(5)->get();
        $latestBooks = Book::latest()->take(5)->get();

        // NEW: Data for User Registration Chart
        $usersPerDay = User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', Carbon::now()->subDays(6)) // From 6 days ago to today
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->pluck('count', 'date');

        $chartLabels = [];
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $chartLabels[] = Carbon::parse($date)->format('D, M j');
            $chartData[] = $usersPerDay->get($date, 0);
        }

        return view('admin.index', compact(
            'users',
            'books',
            'programs',
            'recentUsersCount',
            'recentBooksCount',
            'latestUsers',
            'latestBooks',
            'chartLabels',
            'chartData'
        ));
    }
}
