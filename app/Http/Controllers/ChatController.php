<?php

namespace App\Http\Controllers;

use App\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $rooms = $request->user()->chatRooms()->get();

        return view('chat', [
            'rooms' => $rooms->toJson()
        ]);
    }

    public function show(Request $request)
    {

    }
}
