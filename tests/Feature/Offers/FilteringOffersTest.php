<?php

namespace Tests\Feature\Offers;

use App\Offer;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class FilteringOffersTest extends TestCase
{
    use DatabaseMigrations;

    private $user;

    protected function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function can_be_filtered_by_game_id()
    {
        $firstOffer = factory(Offer::class)->state('active')->create(['seller_id' => $this->user->id]);
        $secondOffer = factory(Offer::class)->state('active')->create(['seller_id' => $this->user->id]);

        $this->get(route('offers.index', ['game_id' => $firstOffer->game_id]))
            ->assertSee($firstOffer->game->title)
            ->assertDontSee($secondOffer->game->title);
    }

    /** @test */
    public function can_be_filtered_by_city_id()
    {
        $firstOffer = factory(Offer::class)->state('active')->create(['seller_id' => $this->user->id]);
        $secondOffer = factory(Offer::class)->state('active')->create(['seller_id' => $this->user->id]);

        $this->get(route('offers.index', ['city' => $firstOffer->city_id]))
            ->assertSee($firstOffer->game->title)
            ->assertDontSee($secondOffer->game->title);
    }

    /** @test */
    public function can_be_filtered_by_platform()
    {
        $firstOffer = factory(Offer::class)->state('active')->create([
            'seller_id' => $this->user->id,
            'platform'  => 9,
        ]);
        $secondOffer = factory(Offer::class)->state('active')->create([
            'seller_id' => $this->user->id,
            'platform'  => 12,
        ]);

        $this->get(route('offers.index', ['platform' => [$firstOffer->platform]]))
            ->assertSee($firstOffer->game->title)
            ->assertDontSee($secondOffer->game->title);
    }

    /** @test */
    public function can_be_filtered_by_multiple_platforms()
    {
        $firstOffer = factory(Offer::class)->state('active')->create([
            'seller_id' => $this->user->id,
            'platform'  => 9,
        ]);
        $secondOffer = factory(Offer::class)->state('active')->create([
            'seller_id' => $this->user->id,
            'platform'  => 12,
        ]);
        $thirdOffer = factory(Offer::class)->state('active')->create([
            'seller_id' => $this->user->id,
            'platform'  => 48,
        ]);

        $this->get(route('offers.index', ['platform' => [$firstOffer->platform, $thirdOffer->platform]]))
            ->assertSee($firstOffer->game->title)
            ->assertSee($thirdOffer->game->title)
            ->assertDontSee($secondOffer->game->title);
    }

    /** @test */
    public function can_be_filtered_by_price()
    {
        $firstOffer = factory(Offer::class)->state('active')->create(['seller_id' => $this->user->id, 'price' => '100.00']);
        $secondOffer = factory(Offer::class)->state('active')->create(['seller_id' => $this->user->id, 'price' => '150.00']);

        $this->get(route('offers.index', ['price' => '70,120']))
            ->assertSee($firstOffer->game->title)
            ->assertDontSee($secondOffer->game->title);

        $this->get(route('offers.index', ['price' => '100,100']))
            ->assertSee($firstOffer->game->title)
            ->assertDontSee($secondOffer->game->title);

        $this->get(route('offers.index', ['price' => '145,160']))
            ->assertDontSee($firstOffer->game->title)
            ->assertSee($secondOffer->game->title);

        $this->get(route('offers.index', ['price' => '50,60']))
            ->assertDontSee($firstOffer->game->title)
            ->assertDontSee($secondOffer->game->title);
    }
}
