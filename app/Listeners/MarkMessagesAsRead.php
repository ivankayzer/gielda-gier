<?php

namespace App\Listeners;

use App\ChatRoom;

class MarkMessagesAsRead
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        ChatRoom::markAsRead();
    }
}
