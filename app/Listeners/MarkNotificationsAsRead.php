<?php

namespace App\Listeners;

use App\Notification;

class MarkNotificationsAsRead
{
    /**
     * Handle the event.
     *
     * @param object $event
     *
     * @return void
     */
    public function handle($event)
    {
        Notification::markAsRead();
    }
}
