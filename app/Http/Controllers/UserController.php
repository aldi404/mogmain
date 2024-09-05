<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function index_events()
    {
        return view('user.events');
    }

    public function detail_events($slug)
    {
        return view('user.detail_events', compact('slug'));
    }

    public function services()
    {
        return view('user.services');
    }

    public function news()
    {
        return view('user.news');
    }

    public function clients()
    {
        return view('user.clients');
    }

    public function meet_the_teams()
    {
        return view('user.meet_the_teams');
    }

    public function contact()
    {
        return view('user.contact');
    }
}
