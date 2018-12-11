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
    public $review;

    /**
     * Create a new event instance.
     *
     * @param Review $review
     */
    public function __construct(Review $review)
    {
        $this->review = $review;
    }
}
