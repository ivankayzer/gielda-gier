<?php

namespace Tests\Feature\Offers;

use App\Offer;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class SortingOffersTest extends TestCase
{
    use DatabaseMigrations;

    private $user;

    protected function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function can_be_sorted_by_date_from_old_to_new()
    {
        $firstOffer = factory(Offer::class)->state('active')->create([
            'seller_id'  => $this->user->id,
            'publish_at' => '2019-01-01 12:00:00',
        ]);

        $secondOffer = factory(Offer::class)->state('active')->create([
            'seller_id'  => $this->user->id,
            'publish_at' => '2019-01-01 13:00:00',
        ]);

        $this->get(route('offers.index', ['sort' => 'date_desc']))
            ->assertSeeInOrder([$secondOffer->game->title, $firstOffer->game->title]);
    }

    /** @test */
    public function can_be_sorted_by_date_from_new_to_old()
    {
        $firstOffer = factory(Offer::class)->state('active')->create([
            'seller_id'  => $this->user->id,
            'publish_at' => '2019-01-01 12:00:00',
        ]);

        $secondOffer = factory(Offer::class)->state('active')->create([
            'seller_id'  => $this->user->id,
            'publish_at' => '2019-01-01 13:00:00',
        ]);

        $this->get(route('offers.index', ['sort' => 'date_asc']))
            ->assertSeeInOrder([$firstOffer->game->title, $secondOffer->game->title]);
    }

    /** @test */
    public function can_be_sorted_by_price_from_cheapest_to_most_expensive()
    {
        $firstOffer = factory(Offer::class)->state('active')->create([
            'seller_id' => $this->user->id,
            'price'     => '10',
        ]);

        $secondOffer = factory(Offer::class)->state('active')->create([
            'seller_id' => $this->user->id,
            'price'     => '20',
        ]);

        $this->get(route('offers.index', ['sort' => 'price_desc']))
            ->assertSeeInOrder([$secondOffer->game->title, $firstOffer->game->title]);
    }

    /** @test */
    public function can_be_sorted_by_price_from_most_expensive_to_cheapest()
    {
        $firstOffer = factory(Offer::class)->state('active')->create([
            'seller_id' => $this->user->id,
            'price'     => '10',
        ]);

        $secondOffer = factory(Offer::class)->state('active')->create([
            'seller_id' => $this->user->id,
            'price'     => '20',
        ]);

        $this->get(route('offers.index', ['sort' => 'price_asc']))
            ->assertSeeInOrder([$firstOffer->game->title, $secondOffer->game->title]);
    }
}
