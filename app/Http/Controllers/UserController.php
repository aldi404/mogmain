<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function services()
    {
        return view('user.services');
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
        return view('user.events');
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
}
