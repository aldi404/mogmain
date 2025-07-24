<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\RegistrationForm;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_events' => Event::count(),
            'active_events' => Event::where('status', 'published')->count(),
            'total_registrations' => EventRegistration::count(),
            'pending_registrations' => EventRegistration::where('status', 'pending')->count(),
        ];

        $recentRegistrations = EventRegistration::with(['registrationForm.event'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $upcomingEvents = Event::where('event_date', '>=', now())
            ->where('status', 'published')
            ->orderBy('event_date')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentRegistrations', 'upcomingEvents'));
    }
}
