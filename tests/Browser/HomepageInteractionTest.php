<?php

namespace Tests\Browser;

use Tests\DuskBrowser;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class HomepageInteractionTest extends DuskTestCase
{
    /**
     * @test
     */
    public function homepage_can_be_visited()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('home'))
                ->assertSee(__('welcome.intro'));
        });
    }

    /**
     * @test
     */
    public function user_can_search_games_from_the_homepage()
    {
        $this->browse(function (DuskBrowser $browser) {
            $browser->visit(route('home'));
            $browser->select2('cities', 'Warszawa')
                    ->select2('games', 'Far Cry 5')
                    ->click('#welcome-search button[type="submit"]')
                    ->assertQueryStringHas('city', '1')
                    ->assertQueryStringHas('game_id', '28552');
        });
    }

    /**
     * @test
     */
    public function user_can_search_games_without_city()
    {
        $this->browse(function (DuskBrowser $browser) {
            $browser->visit(route('home'));
            $browser->select2('games', 'Far Cry 5')
                ->click('#welcome-search button[type="submit"]')
                ->assertQueryStringHas('game_id', '28552');
        });
    }

    /**
     * @test
     */
    public function user_can_search_games_without_particular_game_selected()
    {
        $this->browse(function (DuskBrowser $browser) {
            $browser->visit(route('home'));
            $browser->select2('cities', 'Warszawa')
                ->click('#welcome-search button[type="submit"]')
                ->assertQueryStringHas('city', '1');
        });
    }
}
