<?php

namespace App\Http\Controllers;

use App\City;
use App\Game;
use App\Http\Requests\AjaxRequest;

class AjaxController extends Controller
{
    public function game(AjaxRequest $request)
    {
        $query = $request->get('q');

        return Game::where('title', 'like', "%{$query}%")->limit(10)->get()->map(function ($game) {
            return ['id' => $game->igdb_id, 'text' => $game->title];
        })->toJson();
    }

    public function cities(AjaxRequest $request)
    {
        $query = $request->get('q');

        return City::where('name', 'like', "%{$query}%")->limit(10)->get()->map(function ($city) {
            return ['id' => $city->id, 'text' => $city->name];
        })->toJson();
    }

    public function platforms(AjaxRequest $request)
    {
        $query = $request->get('q');

        return Game::where('igdb_id', $query)->first()->platforms;
    }
}
