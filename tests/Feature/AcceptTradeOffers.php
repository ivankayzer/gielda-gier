<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcceptTradeOffers extends TestCase
{
    /** @test */
    public function cant_accept_two_trades_at_once()
    {
        // @TODO
    }

    /** @test */
    public function accepted_trade_offers_offer_is_not_visible_on_offers_listing()
    {
        // @TODO
    }

    /** @test */
    public function cant_be_traded_after_trade_has_been_accepted()
    {
        // @TODO
    }
}
