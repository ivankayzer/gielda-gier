<?php

namespace App\Events\Comments;

use App\Review;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentCreated
{
    use Dispatchable;
    use SerializesModels;

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
