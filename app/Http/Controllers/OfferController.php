<?php

namespace App\Http\Controllers;

use App\City;
use App\Components\Language;
use App\Components\Platform;
use App\Events\Offers\OfferCreated;
use App\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Offer::filter($request->all())->active();

        $offers = $query->paginate(10);

        $cities = City::all()->pluck('name', 'slug');

        $minPrice = $query->where('price', '>', 0)->min('price') / 100;
        $maxPrice = $query->where('price', '>', 0)->max('price') / 100;

        return view('offers.index', [
            'offers' => $offers,
            'cities' => $cities,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $platforms = Platform::availablePlatforms();
        $languages = Language::availableLanguages();

        return view('offers.create', [
            'platforms' => $platforms,
            'languages' => $languages,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $offer = $request->user()->offers()->create($request->only([
            'game_id',
            'platform',
            'language',
            'price',
            'payment_bank_transfer',
            'payment_cash',
            'delivery_post',
            'delivery_in_person',
            'comment',
            'sellable',
            'tradeable',
            'is_published',
            'publish_at'
        ]));

        foreach ($request->file('images') as $file) {
            if ($file->isValid()) {
                $offer->image()->create(['url' => $file->store('offers', 'public')])->save();
            }
        }

        event(new OfferCreated($offer));

        session()->flash('message', [
            'text' => __('offers.write_success'),
        ]);

        return redirect()->route('offers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer, $slug)
    {
        $similar = $offer->getSimilar(3);
        $platforms = Platform::availablePlatforms();

        return view('offers.show', [
            'offer' => $offer,
            'similar' => $similar,
            'platforms' => $platforms
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        //
    }
}
