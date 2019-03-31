<?php

namespace Tests\Feature\Transactions;

use App\Game;
use App\Notifications\NewTradeOffer;
use App\Offer;
use App\Transaction;
use App\User;
use App\ValueObjects\TransactionStatus;
use App\ValueObjects\TransactionType;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class TradeGamesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guests_cant_see_trade_button()
    {
        $offer = factory(Offer::class)->states(['active', 'user'])->create();

        $this->get($this->offerRoute($offer))
            ->assertDontSee(__('offers.trade'));
    }

    /** @test */
    public function seller_doesnt_see_trade_button_on_own_offers()
    {
        $offer = factory(Offer::class)->states(['active', 'user'])->create();

        $this->actingAs($offer->seller)->get($this->offerRoute($offer))
            ->assertDontSee(__('offers.trade'));
    }

    /** @test */
    public function trade_button_is_visible()
    {
        $user = factory(User::class)->create();
        $offer = factory(Offer::class)->states(['tradeable', 'user'])->create();

        $this->actingAs($user)->get($this->offerRoute($offer))
            ->assertSee(__('offers.trade'));
    }

    /** @test */
    public function can_trade_a_game_for_another_game()
    {
        $user = factory(User::class)->create();
        $offer = factory(Offer::class)->states(['active', 'user'])->create();
        $game = factory(Game::class)->create();

        $this->actingAs($user)->post(route('transactions.create'), [
            'offer_id' => $offer->id,
            'type' => TransactionType::TRADE,
            'game_id' => $game->igdb_id,
            'platform' => 9
        ]);

        $this->assertDatabaseHas('offers', ['id' => $offer->id, 'sold' => false]);
        $this->assertDatabaseHas('transactions', [
            'offer_id' => $offer->id,
            'status_id' => TransactionStatus::PENDING,
            'buyer_game_id' => $game->igdb_id,
            'buyer_game_platform' => 9
        ]);
    }

    /** @test */
    public function game_id_is_required_to_trade_for_another_game()
    {
        $user = factory(User::class)->create();
        $offer = factory(Offer::class)->states(['active', 'user'])->create();

        $this->actingAs($user)->post(route('transactions.create'), [
            'offer_id' => $offer->id,
            'type' => TransactionType::TRADE,
        ])->assertSessionHasErrors('game_id');
    }

    /** @test */
    public function platform_is_required_to_trade_for_another_game()
    {
        $user = factory(User::class)->create();
        $offer = factory(Offer::class)->states(['active', 'user'])->create();

        $this->actingAs($user)->post(route('transactions.create'), [
            'offer_id' => $offer->id,
            'type' => TransactionType::TRADE,
        ])->assertSessionHasErrors('platform');
    }

    /** @test */
    public function money_amount_should_be_numeric_when_trading_for_money()
    {
        $user = factory(User::class)->create();
        $offer = factory(Offer::class)->states(['active', 'user'])->create();

        $this->actingAs($user)->post(route('transactions.create'), [
            'offer_id' => $offer->id,
            'type' => TransactionType::TRADE,
            'money' => 'not-valid-money'
        ])->assertSessionHasErrors('money');
    }

    /** @test */
    public function money_amount_should_be_properly_formatted_when_trading_for_money()
    {
        $user = factory(User::class)->create();
        $offer = factory(Offer::class)->states(['active', 'user'])->create();

        $this->actingAs($user)->post(route('transactions.create'), [
            'offer_id' => $offer->id,
            'type' => TransactionType::TRADE,
            'money' => '10'
        ]);

        $this->assertDatabaseHas('transactions', [
            'status_id' => TransactionStatus::PENDING,
            'price' => '1000'
        ]);

        $this->actingAs($user)->post(route('transactions.create'), [
            'offer_id' => $offer->id,
            'type' => TransactionType::TRADE,
            'money' => '15.00'
        ]);

        $this->assertDatabaseHas('transactions', [
            'status_id' => TransactionStatus::PENDING,
            'price' => '1500'
        ]);

        $this->actingAs($user)->post(route('transactions.create'), [
            'offer_id' => $offer->id,
            'type' => TransactionType::TRADE,
            'money' => '25,00'
        ]);

        $this->assertDatabaseHas('transactions', [
            'status_id' => TransactionStatus::PENDING,
            'price' => '2500'
        ]);
    }

    /** @test */
    public function can_trade_a_game_for_another_game_and_money()
    {
        $user = factory(User::class)->create();
        $offer = factory(Offer::class)->states(['active', 'user'])->create();
        $game = factory(Game::class)->create();

        $this->actingAs($user)->post(route('transactions.create'), [
            'offer_id' => $offer->id,
            'game_id' => $game->igdb_id,
            'platform' => 9,
            'type' => TransactionType::TRADE
        ]);

        $this->assertDatabaseHas('transactions', [
            'offer_id' => $offer->id,
            'status_id' => TransactionStatus::PENDING,
            'buyer_game_id' => $game->igdb_id,
            'buyer_game_platform' => 9,
        ]);
    }

    /** @test */
    public function can_trade_a_game_for_proposed_amount_of_money()
    {
        $user = factory(User::class)->create();
        $offer = factory(Offer::class)->states(['active', 'user'])->create();

        $this->actingAs($user)->post(route('transactions.create'), [
            'offer_id' => $offer->id,
            'type' => TransactionType::TRADE,
            'money' => '10'
        ]);

        $this->assertDatabaseHas('transactions', [
            'offer_id' => $offer->id,
            'status_id' => TransactionStatus::PENDING,
            'price' => '1000',
        ]);
    }

    /** @test */
    public function can_send_multiple_offers_for_the_same_game_twice()
    {
        $user = factory(User::class)->create();
        $offer = factory(Offer::class)->states(['active', 'user'])->create();

        $this->actingAs($user)->post(route('transactions.create'), [
            'offer_id' => $offer->id,
            'type' => TransactionType::TRADE,
            'money' => '10'
        ]);

        $this->actingAs($user)->post(route('transactions.create'), [
            'offer_id' => $offer->id,
            'type' => TransactionType::TRADE,
            'money' => '20'
        ]);

        $this->assertEquals(2, Transaction::where([
            'offer_id' => $offer->id,
            'status_id' => TransactionStatus::PENDING
        ])->count());
    }

    /** @test */
    public function cant_trade_own_offer()
    {
        $user = factory(User::class)->create();
        $offer = factory(Offer::class)->states(['active'])->create([
            'seller_id' => $user->id
        ]);

        $this->actingAs($user)->post(route('transactions.create'), [
            'offer_id' => $offer->id,
            'type' => TransactionType::TRADE,
            'money' => '10'
        ]);

        $this->assertDatabaseMissing('transactions', [
            'offer_id' => $offer->id,
            'status_id' => TransactionStatus::PENDING,
        ]);
    }

    /** @test */
    public function seller_should_receive_an_email_when_new_trade_offer_is_created()
    {
        $user = factory(User::class)->create();
        $offer = factory(Offer::class)->states(['active', 'user'])->create();

        Notification::fake();

        Notification::assertNothingSent();

        $this->actingAs($user)->post(route('transactions.create'), [
            'offer_id' => $offer->id,
            'type' => TransactionType::TRADE,
            'money' => '10'
        ]);

        Notification::assertSentTo($offer->seller, NewTradeOffer::class);
    }

    /** @test */
    public function seller_should_not_receive_an_email_if_he_has_not_given_the_consent()
    {
        $user = factory(User::class)->create();
        $offer = factory(Offer::class)->states(['active', 'user'])->create();
        $offer->seller->profile->update(['notify_new_offer' => false]);

        Notification::fake();

        Notification::assertNothingSent();

        $this->actingAs($user)->post(route('transactions.create'), [
            'offer_id' => $offer->id,
            'type' => TransactionType::TRADE,
            'money' => '10'
        ]);

        Notification::assertNothingSent();
    }

    private function offerRoute($offer)
    {
        return route('offers.show', ['offer' => $offer->id, 'slug' => $offer->game->slug]);
    }
}
