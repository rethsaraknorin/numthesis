<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AdminLayoutComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view)
    {
        $admin = Auth::user();
        $unreadNotifications = [];
        $unreadCount = 0;

        if ($admin) {
            $unreadNotifications = $admin->unreadNotifications()->limit(5)->get();
            $unreadCount = $admin->unreadNotifications()->count();
        }

        // Share the count and the notification objects with the view
        $view->with('pendingUserCount', $unreadCount);
        $view->with('pendingUsersForLayout', $unreadNotifications);
    }
}