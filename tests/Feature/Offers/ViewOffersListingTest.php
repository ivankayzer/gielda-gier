<?php

namespace Tests\Feature\Offers;

use App\Offer;
use App\Profile;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ViewOffersListingTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_see_published_offers()
    {
        $firstUser = factory(User::class)->create();
        $secondUser = factory(User::class)->create();

        $offer = factory(Offer::class)->state('active')->create([
            'seller_id' => $firstUser->id,
        ]);

        $this->actingAs($secondUser)
            ->get(route('offers.index'))
            ->assertSee($offer->game->title);
    }

    /** @test */
    public function guest_can_see_published_offers()
    {
        $user = factory(User::class)->create();

        $offer = factory(Offer::class)->state('active')->create([
            'seller_id' => $user->id,
        ]);

        $this->get(route('offers.index'))->assertSee($offer->game->title);
    }

    /** @test */
    public function users_cant_see_unpublished_offers()
    {
        $firstUser = factory(User::class)->create();
        $secondUser = factory(User::class)->create();

        $offer = factory(Offer::class)->create([
            'seller_id' => $firstUser->id,
            'is_published' => false
        ]);

        $this->actingAs($secondUser)
            ->get(route('offers.index'))
            ->assertDontSee($offer->game->title);
    }

    /** @test */
    public function guest_cant_access_my_offers_page()
    {
        $this->get(route('my-offers.index'))->assertLocation(route('login'));
    }

    /** @test */
    public function user_can_see_own_published_and_unpublished_offers_on_my_offers_page()
    {
        $user = factory(User::class)->create();

        $offer = factory(Offer::class)->create([
            'seller_id' => $user->id,
            'is_published' => false
        ]);

        $publishedOffer = factory(Offer::class)->state('active')->create([
            'seller_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->get(route('my-offers.index'))
            ->assertSee($offer->game->title)
            ->assertSee(__('offers.is_published'));

        $this->actingAs($user)
            ->get(route('my-offers.index'))
            ->assertSee($publishedOffer->game->title)
            ->assertSee(__('offers.not_published'));
    }

    /** @test */
    public function user_cant_see_others_offers_on_my_offers_page()
    {
        $user = factory(User::class)->create();
        $secondUser = factory(User::class)->create();

        $offer = factory(Offer::class)->state('active')->create([
            'seller_id' => $user->id,
        ]);

        $secondUsersProfile = factory(Offer::class)->state('active')->create([
            'seller_id' => $secondUser->id,
        ]);

        $this->actingAs($user)
            ->get(route('my-offers.index'))
            ->assertSee($offer->game->title)
            ->assertDontSee($secondUsersProfile->game->title);
    }

    /** @test */
    public function offer_should_not_be_visible_if_sold()
    {
        $firstUser = factory(User::class)->create();
        $secondUser = factory(User::class)->create();

        $offer = factory(Offer::class)->state('active')->create([
            'seller_id' => $firstUser->id,
            'sold' => true
        ]);

        $this->actingAs($secondUser)
            ->get(route('offers.index'))
            ->assertDontSee($offer->game->title);

        $this->actingAs($firstUser)
            ->get(route('offers.index'))
            ->assertDontSee($offer->game->title);
    }

    /** @test */
    public function can_see_offer_details()
    {
        $firstUser = factory(User::class)->create();

        $offer = factory(Offer::class)->state('active')->create([
            'seller_id' => $firstUser->id,
        ]);

        $this->get(route('offers.index'))
            ->assertSee($offer->game->title)
            ->assertSee($offer->platform)
            ->assertSee($offer->language)
            ->assertSee($offer->formatted_price)
            ->assertSee($offer->publish_at->diffForHumans())
            ->assertSee($offer->city->name)
            ->assertSee($offer->seller->name)
            ->assertSee($offer->seller->positiveReviewsCount())
            ->assertSee($offer->seller->negativeReviewsCount())
            ->assertSee($offer->game->cover);
    }
}
