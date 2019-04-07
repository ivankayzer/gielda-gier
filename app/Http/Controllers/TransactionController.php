<?php

namespace App\Http\Controllers;

use App\Events\Comments\CommentCreated;
use App\Events\Transactions\TransactionAccepted;
use App\Events\Transactions\TransactionCompleted;
use App\Events\Transactions\TransactionCreated;
use App\Events\Transactions\TransactionDeclined;
use App\Events\Transactions\VisitTransactionsPage;
use App\Factories\TransactionFactory;
use App\Http\Requests\CreateTransactionRequest;
use App\Offer;
use App\Review;
use App\Transaction;
use App\ValueObjects\TransactionStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $completed = $user->transactionsBuyer()->completed()->union($user->transactionsSeller()->completed())->unionPaginate(10);

        $active = $user->transactionsBuyer()->active()->union($user->transactionsSeller()->active())->get();
        $pending = $user->transactionsSeller()->pending()->get();

        $toRate = $user->transactionsBuyer()->toRate('buyer')->union($user->transactionsSeller()->toRate('seller'))->get();

        event(new VisitTransactionsPage());

        return view('transactions.index', [
            'active' => $active,
            'pending' => $pending,
            'completed' => $completed,
            'toRate' => $toRate,
            'isEmpty' => !count($active) && !count($pending) && !count($completed) && !count($toRate)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateTransactionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTransactionRequest $request)
    {
        /** @var Offer $offer */
        $offer = Offer::active()->findOrFail($request->get('offer_id'));
        $transaction = TransactionFactory::fromOffer($offer, $request);

        $saved = $transaction->save();

        if ($saved && !$transaction->isTrade()) {
            $offer->sold = true;
            $offer->save();
        }

        if ($saved) {
            event(new TransactionCreated($transaction));
            session()->flash('message', ['text' => __('common.offer_created')]);
        }

        if ($transaction->isTrade()) {
            return redirect()->route('offers.show', ['offer' => $offer->id, 'slug' => $offer->game->slug]);
        }

        return redirect()->route('transactions.index');
    }

    public function accept(Transaction $transaction)
    {
        if ($transaction->seller_id != auth()->user()->id || $transaction->status_id != TransactionStatus::PENDING) {
            abort(404);
        }

        $transaction->update([
            'status_id' => TransactionStatus::IN_PROGRESS
        ]);

        $transaction->offer->sold = true;
        $transaction->offer->save();

        event(new TransactionAccepted($transaction->id));

        return back();
    }

    public function decline(Transaction $transaction)
    {
        if ($transaction->seller_id != auth()->user()->id || $transaction->status_id != TransactionStatus::PENDING) {
            abort(404);
        }

        $transaction->update([
            'status_id' => TransactionStatus::DECLINED
        ]);

        event(new TransactionDeclined($transaction->id));

        return back();
    }

    public function showInfo(Transaction $transaction)
    {
        $user = $transaction->otherPerson;

        return view('chunks.user_info', [
            'profile' => $user->profile
        ]);
    }

    public function rate(Request $request)
    {
        $this->validate($request, [
            'type' => ['required', Rule::in(['positive', 'negative'])],
            'transaction_id' => 'required'
        ]);

        /** @var Transaction $transaction */
        $transaction = Transaction::where('id', $request->get('transaction_id'))->where(function ($query) use ($request) {
            return $query->where('buyer_id', $request->user()->id)->orWhere('seller_id', $request->user()->id);
        })->firstOrFail();

        $comment = new Review([
            'user_id' => $transaction->otherPerson->id,
            'transaction_id' => $transaction->id,
            'type' => $request->get('type'),
            'comment' => $request->get('message')
        ]);

        $comment->save();

        event(new CommentCreated($comment));

        $attributes = [
            'status_id' => TransactionStatus::COMPLETED,
            ($transaction->isBuyer() ? 'buyer_comment' : 'seller_comment') => true
        ];

        $transaction->update($attributes);

        event(new TransactionCompleted($transaction->id));

        return back();
    }
}
