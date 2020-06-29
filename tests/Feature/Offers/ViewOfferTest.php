<?php

namespace Tests\Feature\Offers;

use App\Offer;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ViewOfferTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_visit_published_offer_details_page()
    {
        $user = factory(User::class)->create();
        $offer = factory(Offer::class)->state('active')->create(['seller_id' => $user->id]);

        $this->get(route('offers.show', ['offer' => $offer->id, 'slug' => $offer->game->slug]))->assertOk()->assertSee($offer->game->title);
    }

    /** @test */
    public function cant_visit_unpublished_offer_details_page()
    {
        $user = factory(User::class)->create();
        $offer = factory(Offer::class)->create(['seller_id' => $user->id]);

        $this->get(route('offers.show', ['offer' => $offer->id, 'slug' => $offer->game->slug]))
            ->assertDontSee($offer->game->title)
            ->assertLocation(route('home'));
    }

    /** @test */
    public function can_see_offer_details()
    {
        $user = factory(User::class)->create();
        $offer = factory(Offer::class)->state('active')->create(['seller_id' => $user->id]);

        $this->get(route('offers.show', ['offer' => $offer->id, 'slug' => $offer->game->slug]))
            ->assertSee($offer->game->title)
            ->assertSee($offer->platform)
            ->assertSee($offer->language)
            ->assertSee($offer->formatted_price)
            ->assertSee($offer->publish_at->diffForHumans())
            ->assertSee($offer->city->name)
            ->assertSee($offer->seller->name)
            ->assertSee($offer->seller->positiveReviewsCount())
            ->assertSee($offer->seller->negativeReviewsCount())
            ->assertSee($offer->game->cover)
            ->assertSee(__('offers.payment_bank_transfer'))
            ->assertSee(__('offers.payment_cash'))
            ->assertSee(__('offers.delivery_post'))
            ->assertSee(__('offers.delivery_in_person'));
    }
}
