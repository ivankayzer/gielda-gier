<?php

namespace Tests\Browser;

use App\City;
use App\Game;
use App\Offer;
use App\Profile;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class HomepageTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function home_page_is_reachable()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('home'))
                    ->assertSee(__('welcome.intro'));
        });
    }
    
    /** @test */
    public function offers_section_is_not_visible_if_there_are_no_offers()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('home'))
                ->assertDontSee(__('welcome.featured_offers'));
        });
    }

    /** @test */
    public function offers_section_shows_recent_offers()
    {
        $game = factory(Game::class)->create();
        $profile = factory(User::class)->create();
        $city = factory(City::class)->create();

        factory(Offer::class)->state('active')->create([
            'game_id' => $game->igdb_id,
            'seller_id' => $profile->user_id,
            'city_id' => $city
        ]);

        $this->browse(function (Browser $browser) use ($game) {
            $browser->visit(route('home'))
                ->assertSee(__('welcome.featured_offers'))
                ->assertSee($game->title);
        });
    }
}
