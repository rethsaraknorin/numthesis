<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Program;
use App\Models\Course; // Add this import
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application admin dashboard.
     */
    public function index()
    {
        // --- DATA FOR 3-CARD LAYOUT ---
        $totalUserCount = User::where('role', 'user')->count();
        $totalPrograms = Program::count();
        $totalBooks = Book::count();

        // --- NEW: Secondary Stats for Cards ---
        $pendingRequestCount = User::whereNotNull('student_id')->where('is_approved', false)->count();
        $approvedStudentCount = User::where('is_approved', true)->count();
        $totalCourses = Course::count();
        $recentBooksCount = Book::where('created_at', '>=', Carbon::now()->subWeek())->count();
        
        // --- Data for Widgets ---
        $latestBooks = Book::latest()->take(5)->get();
        $recentPendingUsers = User::whereNotNull('student_id')->where('is_approved', false)->latest()->take(5)->get();

        // Data for User Registration Chart
        $usersPerDay = User::where('role', 'user')->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', Carbon::now()->subDays(6))
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
            'totalUserCount',
            'totalPrograms',
            'totalBooks',
            'pendingRequestCount', // New data
            'approvedStudentCount', // New data
            'totalCourses', // New data
            'recentBooksCount', // New data
            'latestBooks',
            'recentPendingUsers',
            'chartLabels',
            'chartData'
        ));
    }
}