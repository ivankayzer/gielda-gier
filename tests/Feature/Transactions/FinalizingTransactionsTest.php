<?php

namespace Tests\Feature\Transactions;

use App\Offer;
use App\Transaction;
use App\User;
use App\ValueObjects\TransactionStatus;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class FinalizingTransactionsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function type_is_required()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)->post(route('transactions.rate'))->assertSessionHasErrors(['type']);
    }

    /** @test */
    public function transaction_id_is_required()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)->post(route('transactions.rate'))->assertSessionHasErrors(['transaction_id']);
    }

    /** @test */
    public function can_finalize_transaction_by_leaving_negative_comment()
    {
        $user = factory(User::class)->create();
        /** @var User $buyer */
        $buyer = factory(User::class)->create();
        $offer = factory(Offer::class)->state('active')->create(['seller_id' => $user->id]);

        $transaction = factory(Transaction::class)->create([
            'buyer_id'  => $buyer->id,
            'seller_id' => $user->id,
            'offer_id'  => $offer->id,
            'status_id' => TransactionStatus::IN_PROGRESS,
        ]);

        $this->actingAs($user)
            ->post(route('transactions.rate'), [
                'type'           => 'negative',
                'transaction_id' => $transaction->id,
            ]);

        $this->assertDatabaseHas('reviews', [
            'type'           => 'negative',
            'transaction_id' => $transaction->id,
        ]);

        $this->assertEquals(1, $buyer->negativeReviewsCount());
    }

    /** @test */
    public function can_finalize_transaction_by_leaving_positive_comment()
    {
        $user = factory(User::class)->create();
        /** @var User $buyer */
        $buyer = factory(User::class)->create();
        $offer = factory(Offer::class)->state('active')->create(['seller_id' => $user->id]);

        $transaction = factory(Transaction::class)->create([
            'buyer_id'  => $buyer->id,
            'seller_id' => $user->id,
            'offer_id'  => $offer->id,
            'status_id' => TransactionStatus::IN_PROGRESS,
        ]);

        $this->actingAs($user)
            ->post(route('transactions.rate'), [
                'type'           => 'positive',
                'transaction_id' => $transaction->id,
            ]);

        $this->assertDatabaseHas('reviews', [
            'type'           => 'positive',
            'transaction_id' => $transaction->id,
        ]);

        $this->assertEquals(1, $buyer->positiveReviewsCount());
    }

    public function can_finalize_only_own_transactions()
    {
    }
}
