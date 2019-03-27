<?php

namespace Tests\Browser;

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
           $browser->visit(route('offers.index', ['game_id' => $game]))->assertSee($game->title);
        });
    }
}
