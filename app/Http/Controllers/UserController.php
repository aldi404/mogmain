<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventCategory;
use App\Models\EventItem;
use App\Models\ServicePortfolio;

class UserController extends Controller
{
    public function index()
    {
        // Fetch event categories and some event items for homepage
        $eventCategories = EventCategory::with('events')->get();
        $featuredEvents = EventItem::with(['category', 'images'])->take(6)->get();
        // Fetch all service portfolios for homepage
        $servicePortfolios = ServicePortfolio::with('images')->get();

        return view('user.index', compact('eventCategories', 'featuredEvents', 'servicePortfolios'));
    }

    public function services()
    {
        // Fetch all service portfolios with images for detail page
        $servicePortfolios = ServicePortfolio::with('images')->get();
        
        return view('user.services', compact('servicePortfolios'));
    }

    public function events()
    {
        return view('user.events.index_events');
    }

    public function news()
    {
        return view('user.news');
    }

    public function teams()
    {
        return view('user.teams');
    }

    public function contact()
    {
        return view('user.contact');
    }

    public function contactSubmit(Request $request)
    {
        // Handle contact form submission
        return redirect()->back()->with('success', 'Message sent successfully!');
    }

    public function index_events()
    {
        // Fetch all event items with categories and images
        $events = EventItem::with(['category', 'images'])->get();

        return view('user.events', compact('events'));
    }

    public function careers()
    {
        return view('user.career');
    }

    public function hugocray()
    {
        return view('user.hugocray');
    }

    public function about()
    {
        return view('user.about');
    }

    public function products()
    {
        return view('user.products');
    }

    public function partnerships()
    {
        return view('user.partnerships');
    }

    public function show_event($id)
    {
        // Fetch event item with category and images
        $event = EventItem::with(['category', 'images'])->findOrFail($id);

        return view('user.event-detail', compact('event'));
    }
}
