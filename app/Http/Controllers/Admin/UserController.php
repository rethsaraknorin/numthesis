<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of all users with the 'user' role.
     */
    public function index()
    {
        // Fetch only users where the 'role' column is 'user'
        $users = User::where('role', 'user')->get();
        
        // Pass the filtered users collection to the view
        return view('admin.users.index', compact('users'));
    }

    /**
     * Remove the specified user from the database.
     */
    public function destroy(User $user)
    {
        // Prevent an admin from deleting another admin
        if ($user->isAdmin()) {
            return back()->with('error', 'Cannot delete an administrator.');
        }

        $user->delete();

        return back()->with('success', 'User has been deleted successfully.');
    }
}
