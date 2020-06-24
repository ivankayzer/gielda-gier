<?php

namespace App\Http\Controllers;

use App\City;
use App\Game;
use App\Http\Requests\DeleteOfferRequest;
use App\ValueObjects\Language;
use App\ValueObjects\Platform;
use App\Services\Price;
use App\Events\Offers\OfferCreated;
use App\Http\Requests\CreateOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
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
        $query = Offer::filter($request->all())->with(['game', 'city'])->active();

        $offers = $query->paginate(10);

        if ($request->has('city')) {
            $city = City::find($request->get('city'));
        }

        if ($request->has('game_id')) {
            $game = Game::where('igdb_id', $request->get('game_id'))->first();
        }

        return view('offers.index', [
            'offers' => $offers,
            'cities' => City::getList(),
            'maxPrice' => Offer::max('price') / 100,
            'isFiltered' => !empty($request->all()),
            'selectedCity' => isset($city) ? $city->name : __('settings.select_city'),
            'selectedGame' => isset($game) ? $game->title : __('settings.select_game')
        ]);
    }

    public function my(Request $request)
    {
        return view('offers.my', [
            'offers' => $request->user()->offers()->where('sold', false)->orderBy('updated_at', 'desc')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('offers.create', [
            'platforms' => Platform::availablePlatforms(),
            'languages' => Language::availableLanguages(),
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
        return view('offers.edit', [
            'model' => $offer,
            'platforms' => Platform::availablePlatforms(),
            'languages' => Language::availableLanguages(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateOfferRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOfferRequest $request)
    {
        $offer = $request->user()->offers()->create($request->all());

        if ($request->file('images')) {
            foreach ($request->file('images') as $file) {
                if ($file->isValid()) {
                    $offer->image()->create(['url' => $file->store('offers', 'public')])->save();
                }
            }
        }

        event(new OfferCreated($offer));

        session()->flash('message', [
            'text' => __('offers.write_success'),
        ]);

        return redirect()->route('my-offers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function show($offer, $slug)
    {
        $offer = Offer::active()->findOrFail($offer);

        return view('offers.show', [
            'offer' => $offer,
            'similar' => $offer->getSimilar(3),
            'platforms' => Platform::availablePlatforms()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOfferRequest $request, Offer $offer)
    {
        $data = $request->except('game_id');

        $data = collect([
            'payment_bank_transfer' => false,
            'payment_cash' => false,
            'delivery_post' => false,
            'delivery_in_person' => false,
            'sellable' => false,
            'tradeable' => false,
            'is_published' => false
        ])->merge($data)->toArray();

        $offer->fill($data);

        $offer->save();

        return redirect()->route('my-offers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteOfferRequest $request
     * @param  \App\Offer $offer
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function delete(DeleteOfferRequest $request, Offer $offer)
    {
        $offer->delete();

        return back();
    }
}
