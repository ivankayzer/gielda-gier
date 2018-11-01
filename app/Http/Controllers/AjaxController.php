<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function game(Request $request)
    {
        $query = $request->post('q');

        return Game::where('title', 'like', "%{$query}%")->limit(10)->get()->map(function ($game) {
            return [
                'value' => $game->igdb_id,
                'text' => $game->title,
            ];
        })->toJson();
    }

    public function platforms(Request $request)
    {
        $query = $request->post('q');

        return Game::where('igdb_id', $query)->first()->platforms;
    }
}
