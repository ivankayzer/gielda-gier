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

    public function my(Request $request)
    {
        $offers = $request->user()->offers()->where('sold', false)->orderBy('updated_at', 'desc')->paginate(10);

        return view('offers.my', [
            'offers' => $offers,
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
     * Edit the form for creating a new resource.
     *
     * @param Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        $platforms = Platform::availablePlatforms();
        $languages = Language::availableLanguages();

        return view('offers.edit', [
            'model' => $offer,
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {
        $offer->fill($request->all());

        $offer->save();

        return redirect()->route('my-offers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function delete(Offer $offer)
    {
        $offer->delete();

        return back();
    }
}
