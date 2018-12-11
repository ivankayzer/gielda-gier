<?php

namespace App\Events\Comments;

use App\Review;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class CommentCreated
{
    use Dispatchable, SerializesModels;

    /**
     * @var Review
     */
    public $comment;

    /**
     * Create a new event instance.
     *
     * @param Review $comment
     */
    public function __construct(Review $comment)
    {
        $this->comment = $comment;
    }
}
