<?php

namespace App\Http\Controllers;

use App\Chat;
use App\ChatMessage;
use App\ChatRoom;
use App\Events\Chat\ChatMessageSent;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $rooms = $request->user()->chatRooms()->with('user')->get();

        $rooms = $rooms->map(function ($room) {
            $currentUser = $otherUser = null;

            $room->user->map(function ($user) use (&$currentUser, &$otherUser) {
                $userData = [
                    'name' => $user->name,
                    'id' => $user->id,
                    'avatar' => $user->profile->getAvatar()
                ];

                if ($user->id === auth()->user()->id) {
                    $currentUser = $userData;
                } else {
                    $otherUser = $userData;
                }
            });

            return [
                'id' => $room->id,
                'messages' => $room->messages,
                'currentUser' => $currentUser,
                'otherUser' => $otherUser,
            ];
        });

        return view('chat', [
            'rooms' => $rooms->toJson()
        ]);
    }

    public function message(Request $request)
    {
        $room = ChatRoom::find($request->get('room'));

        (new ChatMessage())->fill([
            'sender_id' => $request->user()->id,
            'chat_room_id' => $room->id,
            'message' => $request->get('message'),
            'is_read' => false
        ])->save();

        broadcast(new ChatMessageSent($room, $request->get('message'), $request->user()))->toOthers();
    }

    public function read(Request $request)
    {
        $room = ChatRoom::find($request->get('room'));

        /** @var ChatRoom $room */
        $room->markMessagesReadForUser($request->get('user_id'));
    }
}
