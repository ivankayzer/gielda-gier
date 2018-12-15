<?php

namespace App\Http\Controllers;

use App\Events\Chat\ChatPageVisited;
use App\Events\Notifications\NotificationsPageVisited;
use App\Offer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offer::inRandomOrder()->active()->limit(5)->get();

        return view('welcome')->withOffers($offers);
    }

    public function dashboard()
    {
        event(new NotificationsPageVisited());

        return view('dashboard');
    }

    public function transactions()
    {
        return view('transactions.index');
    }

    public function reviews()
    {
        return view('reviews.index');
    }

    public function chat()
    {
        event(new ChatPageVisited());

        return view('chat');
    }

    public function users()
    {
        return view('users.index');
    }
}
