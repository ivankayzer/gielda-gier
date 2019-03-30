<?php

namespace Tests\Feature;

use App\Offer;
use App\Profile;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class BuyGamesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guests_cant_see_buy_button()
    {
        $offer = factory(Offer::class)->states(['active', 'user'])->create();

        $this->get($this->offerRoute($offer))
            ->assertDontSee(__('offers.buy'));
    }

    /** @test */
    public function seller_doesnt_see_buy_button_on_own_offers()
    {
        $offer = factory(Offer::class)->states(['active', 'user'])->create();

        $this->actingAs($offer->seller)->get($this->offerRoute($offer))
            ->assertDontSee(__('offers.buy'));
    }

    /** @test */
    public function buy_button_is_visible()
    {
        $profile = factory(Profile::class)->create();
        $offer = factory(Offer::class)->states(['active', 'user'])->create();

        $this->actingAs($profile->user)->get($this->offerRoute($offer))
            ->assertSee(__('offers.buy'));
    }

    private function offerRoute($offer)
    {
        return route('offers.show', ['offer' => $offer->id, 'slug' => $offer->game->slug]);
    }
}
