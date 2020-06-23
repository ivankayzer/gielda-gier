<?php

namespace App\Http\Controllers;

use App\Events\Chat\ChatPageVisited;
use App\Events\Notifications\NotificationsPageVisited;
use App\Offer;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome', [
            'offers' => Offer::inRandomOrder()->active()->limit(5)->get()
        ]);
    }

    public function notifications()
    {
        event(new NotificationsPageVisited());

        return view('notifications');
    }

    public function readNotifications()
    {
        event(new NotificationsPageVisited());
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
