<?php

namespace App\Http\Controllers;

use App\Factories\TransactionFactory;
use App\Offer;
use App\Transaction;
use App\ValueObjects\TransactionStatus;
use Illuminate\Http\Request;

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

        return view('transactions.index', [
            'active' => $active,
            'pending' => $pending,
            'completed' => $completed
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $offer = Offer::where('id', $request->get('offer_id'))->firstOrFail();
        $transaction = TransactionFactory::fromOffer($offer, $request);

        if ($transaction->save() && !$transaction->isTrade()) {
            $offer->update([
                'sold' => true
            ]);
        }

        return redirect()->route('transactions.index');
    }

    public function accept(Transaction $transaction)
    {
        $transaction->update([
            'status_id' => TransactionStatus::IN_PROGRESS
        ]);

        return back();
    }

    public function decline(Transaction $transaction)
    {
        $transaction->update([
            'status_id' => TransactionStatus::DECLINED
        ]);

        return back();
    }
}
