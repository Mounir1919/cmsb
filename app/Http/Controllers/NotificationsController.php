<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class NotificationsController extends Controller
{
    public function showNotifications()
    {
        $user = Auth::user();
        $notifications = $user->unreadNotifications;

        return view('notifications', compact('notifications'));
    }
}