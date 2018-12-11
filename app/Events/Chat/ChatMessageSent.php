<?php

namespace App\Events\Chat;

use App\ChatRoom;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChatMessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $room;
    protected $message;
    protected $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ChatRoom $room, $message, $user)
    {
        $this->room = $room;
        $this->message = $message;
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('room.' . $this->room->id);
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'user_id' => $this->user->id
        ];
    }
}
