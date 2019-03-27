<?php

namespace Tests\Browser;

use App\City;
use App\Game;
use App\Offer;
use App\Profile;
use App\ValueObjects\Language;
use App\ValueObjects\Platform;
use Tests\DuskBrowser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AddOfferTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_add_an_offer()
    {
        $profile = factory(Profile::class)->state('withUser')->create();
        $offer = factory(Offer::class)->make();
        $game = factory(Game::class)->create();
        $city = factory(City::class)->create();

        $this->browse(function (DuskBrowser $browser) use ($profile, $game, $city, $offer) {
            $browser->loginAs($profile->user);
            $browser->visit(route('offers.create'))
                ->assertSee(__('offers.add_offer'))
                ->select2('games', $game->title)
                ->select2('cities', $city->name)
                ->select2('platforms', Platform::getLabelById($offer->platform))
                ->select2('language', Language::getLabelById($offer->language))
                ->type('price', $offer->price)
                ->click('button[type="submit"]')
                ->assertSee($game->title);
        });

        $this->assertDatabaseHas('offers', [
            'seller_id' => $profile->user_id,
            'game_id' => $game->igdb_id,
            'platform' => $offer->platform
        ]);
    }

    /** @test */
    public function user_can_set_payment_preferences()
    {
        // @TODO
    }
    
    /** @test */
    public function user_can_set_delivery_preferences()
    {
        // @TODO
    }

    /** @test */
    public function user_can_add_a_comment()
    {
        // @TODO
    }

    /** @test */
    public function user_can_add_images()
    {
        // @TODO
    }

    /** @test */
    public function offer_can_be_published()
    {
        // @TODO
    }

    /** @test */
    public function user_can_set_publish_preferences()
    {
        // @TODO
    }
}
