<?php

namespace Tests\Feature\Transactions;

use App\Transaction;
use App\User;
use App\ValueObjects\TransactionStatus;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ViewTransactionsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_see_own_transactions()
    {
        $user = factory(User::class)->create();
        $transaction = factory(Transaction::class)->create([
            'buyer_id' => $user->id
        ]);

        $this->actingAs($user)
            ->get(route('transactions.index'))
            ->assertSee(__('transactions.number') . $transaction->id);
    }

    /** @test */
    public function cant_see_others_transactions()
    {
        $user = factory(User::class)->create();
        $transaction = factory(Transaction::class)->create([
            'buyer_id' => $user->id
        ]);

        $secondUser = factory(User::class)->create();
        $secondTransaction = factory(Transaction::class)->create([
            'buyer_id' => $secondUser->id
        ]);

        $this->actingAs($user)
            ->get(route('transactions.index'))
            ->assertSee(__('transactions.number') . $transaction->id)
            ->assertDontSee(__('transactions.number') . $secondTransaction->id);
    }

    /** @test */
    public function can_see_own_trade_offers()
    {
        $user = factory(User::class)->create();
        $secondUser = factory(User::class)->create();
        $transaction = factory(Transaction::class)->create([
            'buyer_id' => $secondUser->id,
            'seller_id' => $user->id,
            'status_id' => TransactionStatus::PENDING
        ]);

        $this->actingAs($user)
            ->get(route('transactions.index'))
            ->assertSee(__('transactions.number') . $transaction->id);
    }

    /** @test */
    public function cant_see_others_trade_offers()
    {
        $user = factory(User::class)->create();
        $secondUser = factory(User::class)->create();
        $transaction = factory(Transaction::class)->create([
            'buyer_id' => $secondUser->id,
            'seller_id' => $user->id,
            'status_id' => 1
        ]);
        $secondTransaction = factory(Transaction::class)->create([
            'seller_id' => $secondUser->id,
            'buyer_id' => $user->id,
            'status_id' => 1
        ]);

        $this->actingAs($user)
            ->get(route('transactions.index'))
            ->assertSee(__('transactions.number') . $transaction->id)
            ->assertDontSee(__('transactions.number') . $secondTransaction->id);
    }

    /** @test */
    public function can_see_completed_transactions()
    {
        $user = factory(User::class)->create();
        $transaction = factory(Transaction::class)->create([
            'buyer_id' => $user->id,
            'status_id' => TransactionStatus::COMPLETED
        ]);

        $this->actingAs($user)
            ->get(route('transactions.index'))
            ->assertSee(__('transactions.number') . $transaction->id);
    }
}
