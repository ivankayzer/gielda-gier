<?php

namespace App\Http\Controllers;

use App\Chat;
use App\ChatRoom;
use App\Events\ChatMessageSent;
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

    public function message(Request $request)
    {
        $room = ChatRoom::find($request->get('room'));

        event(new ChatMessageSent($room, $request->get('message')));
    }
}
