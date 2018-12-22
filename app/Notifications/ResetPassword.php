<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends \Illuminate\Auth\Notifications\ResetPassword
{
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        return (new MailMessage)
            ->subject(__('notifications.reset_password_notification'))
            ->line(__('notifications.reset_password_info'))
            ->action(__('notifications.reset_password'), url(config('app.url').route('password.reset', $this->token, false)))
            ->line(__('notifications.reset_no_action'));
    }
}
