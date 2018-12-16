<?php

namespace App\Events\Offers;

use App\Offer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class OfferCreated
{
    use Dispatchable, SerializesModels;

    /**
     * @var Offer
     */
    public $offer;

    /**
     * Create a new event instance.
     *
     * @param Offer $offer
     */
    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
    }
}
