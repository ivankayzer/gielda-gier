<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }

    public function otherUser()
    {
        return $this->user->filter(function (User $user) {
            return $user->id !== auth()->user()->id;
        })->first();
    }

    public function latestMessage()
    {
        return $this->messages()->orderBy('created_at', 'desc')->first();
    }

    public function markMessagesReadForUser($userId)
    {
        $notRead = $this->messages()->unread()->get()->filter(function ($message) use ($userId) {
            return $message->sender_id != $userId;
        })->pluck('id');

        ChatMessage::whereIn('id', $notRead)->update([
            'is_read' => true
        ]);
    }
}
