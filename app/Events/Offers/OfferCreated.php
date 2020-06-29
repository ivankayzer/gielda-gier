<?php

namespace App\Events\Offers;

use App\Offer;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OfferCreated
{
    use Dispatchable;
    use SerializesModels;

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
