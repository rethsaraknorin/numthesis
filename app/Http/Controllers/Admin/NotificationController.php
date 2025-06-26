<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    /**
     * Mark a specific notification as read.
     */
    public function markAsRead(Request $request, DatabaseNotification $notification)
    {
        // Mark the single notification as read
        $notification->markAsRead();

        // Return a success response
        return response()->json(['status' => 'success']);
    }

    /**
     * Mark all unread notifications as read.
     */
    public function markAllAsRead(Request $request)
    {
        // Mark all of the admin's unread notifications as read
        Auth::user()->unreadNotifications->markAsRead();

        return response()->json(['status' => 'success']);
    }
}