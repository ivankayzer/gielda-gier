<?php

namespace Tests\Feature;

use App\City;
use App\Components\Platform;
use App\Game;
use App\Offer;
use App\Profile;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @var City */
    private $city;

    /** @var Game */
    private $game;

    /** @var Profile */
    private $profile;

    public function setUp()
    {
        parent::setUp();

        $this->refreshApplication();

        $this->city = factory(City::class)->create();
        $this->game = factory(Game::class)->create();
        $this->profile = factory(Profile::class)->state('withUser')->create();
    }

    /** @test */
    public function iWantToBeAbleToSearchGamesByCity()
    {
        $profile = factory(Profile::class)->state('withUser')->create(['city' => $this->city->id]);

        $offer = $profile->user->offers()->save(
            factory(Offer::class)->make([
                'is_published' => true,
                'sellable' => true
            ])
        );

        $response = $this->get(route('offers.index', [
            'city' => $this->city->getUrlParam()
        ]));

        $response->assertSee($offer->game->title);
    }

    /** @test */
    public function iWantToBeAbleToSearchGamesByGameTitle()
    {
        $offer = $this->profile->user->offers()->save(
            factory(Offer::class)->make([
                'game_id' => $this->game->igdb_id,
                'is_published' => true,
                'sellable' => true
            ])
        );

        $response = $this->get(route('offers.index', [
            'game_id' => $this->game->getUrlParam()
        ]));

        $response->assertSee($offer->game->title);
    }

    /** @test */
    public function iDontWantToSeeGamesThatDoNotMatchMyFilter()
    {
        $secondGame = factory(Game::class)->create();

        $this->profile->user->offers()->save(
            factory(Offer::class)->make([
                'game_id' => $this->game->igdb_id,
                'is_published' => true,
                'sellable' => true
            ])
        );

        $this->profile->user->offers()->save(
            factory(Offer::class)->make([
                'game_id' => $secondGame->igdb_id,
                'is_published' => true,
                'sellable' => true
            ])
        );

        $response = $this->get(route('offers.index', [
            'game_id' => $this->game->getUrlParam()
        ]));

        $response->assertDontSee($secondGame->title);

        $response = $this->get(route('offers.index', [
            'city_id' => $this->city->getUrlParam()
        ]));

        $response->assertDontSee($this->city->name);
    }

    /** @test */
    public function iWantToFilterGamesByPlatform()
    {
        [$firstPlatform, $secondPlatform] = $this->getRandomPlatforms(2);

        $secondGame = factory(Game::class)->create();

        $this->profile->user->offers()->save(
            factory(Offer::class)->make([
                'platform' => $firstPlatform,
                'game_id' => $this->game->igdb_id,
                'is_published' => true,
                'sellable' => true
            ])
        );

        $this->profile->user->offers()->save(
            factory(Offer::class)->make([
                'platform' => $secondPlatform,
                'game_id' => $secondGame->igdb_id,
                'is_published' => true,
                'sellable' => true
            ])
        );

        $response = $this->get(route('offers.index', [
            'platform' => [$firstPlatform]
        ]));

        $response->assertSee($this->game->title);
        $response->assertDontSee($secondGame->title);
    }

    private function getRandomPlatforms(int $count = 1)
    {
        $platforms = Platform::availablePlatforms();

        uksort($platforms, function () {
            return rand() > rand();
        });

        return collect($platforms)->take($count)->keys()->toArray();
    }
}
