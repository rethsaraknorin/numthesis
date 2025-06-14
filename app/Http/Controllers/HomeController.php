<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Fetch users to display the count on the dashboard
        $users = User::where('role', 'user')->get();

        // Pass the users collection to the admin dashboard view
        return view('admin.index', compact('users'));
    }
}
