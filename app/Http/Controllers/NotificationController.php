<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NotificationController extends Controller
{
    /**
     * Display all notifications.
     */
    public function index(Request $request): View
    {
        $notifications = $request->user()
            ->notifications()
            ->latest()
            ->paginate(15);

        return view('notifications.index', compact('notifications'));
    }

    /**
     * Mark a notification as read and redirect to its destination.
     */
    public function read(Request $request, string $notification): RedirectResponse
    {
        $userNotification = $request->user()
            ->notifications()
            ->findOrFail($notification);

        $userNotification->markAsRead();

        $url = $userNotification->data['url'] ?? null;

        // Check if URL is a valid internal relative path.
        if (
            is_string($url) &&
            str_starts_with($url, '/') &&
            !str_starts_with($url, '//')
        ) {
            return redirect($url);
        }

        // Check if URL is an absolute URL belonging to this application.
        if (is_string($url)) {
            $parsedUrl = parse_url($url);

            if (
                is_array($parsedUrl) &&
                isset($parsedUrl['host']) &&
                strtolower($parsedUrl['host']) === strtolower($request->getHost()) &&
                in_array($parsedUrl['scheme'] ?? '', ['http', 'https'], true)
            ) {
                return redirect()->to($url);
            }
        }

        return redirect()->route('notifications.index');
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead(Request $request): RedirectResponse
    {
        $request->user()
            ->unreadNotifications()
            ->update(['read_at' => now()]);

        return back()->with('success', 'All notifications marked as read.');
    }

    /**
     * Delete a single notification.
     */
    public function destroy(Request $request, string $notification): RedirectResponse
    {
        $userNotification = $request->user()
            ->notifications()
            ->findOrFail($notification);

        $userNotification->delete();

        return back()->with('success', 'Notification deleted successfully.');
    }

    /**
     * Delete all notifications.
     */
    public function destroyAll(Request $request): RedirectResponse
    {
        $request->user()
            ->notifications()
            ->delete();

        return back()->with('success', 'All notifications deleted successfully.');
    }
}
