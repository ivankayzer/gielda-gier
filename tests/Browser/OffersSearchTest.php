<?php

namespace Tests\Browser;

use App\City;
use App\Game;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class OffersSearchTest extends DuskTestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function filters_are_visible()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('offers.index'))
                ->assertSee(__('common.city'))
                ->assertSee(__('common.platform'))
                ->assertSee(__('common.game'));
        });
    }
    
    /** @test */
    public function game_from_request_is_automatically_selected_in_filter_box()
    {
        $game = factory(Game::class)->create();

        $this->browse(function (Browser $browser) use ($game) {
           $browser->visit(route('offers.index') . '?game_id=' . $game->igdb_id)->assertSee($game->title);
        });
    }

    /** @test */
    public function city_from_request_is_automatically_selected_in_filter_box()
    {
        $city = factory(City::class)->create();

        $this->browse(function (Browser $browser) use ($city) {
            $browser->visit(route('offers.index') . '?city=' . $city->id)->assertSee($city->name);
        });
    }

    /** @test */
    public function filtering_by_city_returns_correct_results()
    {
        // @TODO
    }
}
