<?php

namespace Tests\Feature;

use App\Offer;
use App\Profile;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ViewOffersListingTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_see_published_offers()
    {
        $firstUser = factory(Profile::class)->state('withUser')->create();
        $secondUser = factory(Profile::class)->state('withUser')->create();

        $offer = factory(Offer::class)->state('active')->create([
            'seller_id' => $firstUser,
        ]);

        $this->actingAs($secondUser->user)
            ->get(route('offers.index'))
            ->assertSee($offer->game->title);
    }

    /** @test */
    public function guest_can_see_published_offers()
    {
        $user = factory(Profile::class)->state('withUser')->create();

        $offer = factory(Offer::class)->state('active')->create([
            'seller_id' => $user,
        ]);

        $this->get(route('offers.index'))->assertSee($offer->game->title);
    }

    /** @test */
    public function users_cant_see_unpublished_offers()
    {
        $firstUser = factory(Profile::class)->state('withUser')->create();
        $secondUser = factory(Profile::class)->state('withUser')->create();

        $offer = factory(Offer::class)->create([
            'seller_id' => $firstUser->user_id,
            'is_published' => false
        ]);

        $this->actingAs($secondUser->user)
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
        $profile = factory(Profile::class)->state('withUser')->create();

        $offer = factory(Offer::class)->create([
            'seller_id' => $profile->user_id,
            'is_published' => false
        ]);

        $publishedOffer = factory(Offer::class)->state('active')->create([
            'seller_id' => $profile->user_id,
        ]);

        $this->actingAs($profile->user)
            ->get(route('my-offers.index'))
            ->assertSee($offer->game->title)
            ->assertSee(__('offers.is_published'));

        $this->actingAs($profile->user)
            ->get(route('my-offers.index'))
            ->assertSee($publishedOffer->game->title)
            ->assertSee(__('offers.not_published'));
    }

    /** @test */
    public function user_cant_see_others_offers_on_my_offers_page()
    {
        $profile = factory(Profile::class)->state('withUser')->create();
        $secondProfile = factory(Profile::class)->state('withUser')->create();

        $offer = factory(Offer::class)->state('active')->create([
            'seller_id' => $profile->user_id,
        ]);

        $secondUsersProfile = factory(Offer::class)->state('active')->create([
            'seller_id' => $secondProfile->user_id,
        ]);

        $this->actingAs($profile->user)
            ->get(route('my-offers.index'))
            ->assertSee($offer->game->title)
            ->assertDontSee($secondUsersProfile->game->title);
    }

    /** @test */
    public function offer_should_not_be_visible_if_sold()
    {
        $firstUser = factory(Profile::class)->state('withUser')->create();
        $secondUser = factory(Profile::class)->state('withUser')->create();

        $offer = factory(Offer::class)->state('active')->create([
            'seller_id' => $firstUser,
            'sold' => true
        ]);

        $this->actingAs($secondUser->user)
            ->get(route('offers.index'))
            ->assertDontSee($offer->game->title);

        $this->actingAs($firstUser->user)
            ->get(route('offers.index'))
            ->assertDontSee($offer->game->title);
    }
}
