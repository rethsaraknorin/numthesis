<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a list of "Normal Users" (unverified, no student ID).
     */
    public function index(): View
    {
        $users = User::where('role', 'user')
            ->whereNull('student_id')
            ->get();
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * NEW: Display a list of all users (excluding admins).
     */
    public function allUsers(): View
    {
        $users = User::where('role', 'user')->get();
        
        return view('admin.users.all', compact('users'));
    }

    /**
     * Display a list of users pending verification.
     */
    public function requests(): View
    {
        $pendingUsers = User::where('role', 'user')
            ->whereNotNull('student_id')
            ->where('is_approved', false)
            ->get();

        return view('admin.users.requests', compact('pendingUsers'));
    }

    /**
     * Display a list of approved students.
     */
    public function students(): View
    {
        $approvedUsers = User::where('role', 'user')
            ->where('is_approved', true)
            ->get();

        return view('admin.users.students', compact('approvedUsers'));
    }

    /**
     * Approve a user and set their status.
     */
    public function approve(Request $request, User $user)
    {
        $user->update([
            'is_approved' => true,
        ]);

        return redirect()->route('admin.users.requests')->with('success', 'User has been approved successfully.');
    }

    /**
     * Remove the specified user from the database.
     */
    public function destroy(User $user)
    {
        if ($user->isAdmin()) {
            return back()->with('error', 'Cannot delete an administrator.');
        }

        $user->delete();

        return back()->with('success', 'User has been deleted successfully.');
    }
}