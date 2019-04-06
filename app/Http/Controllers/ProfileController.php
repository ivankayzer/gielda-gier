<?php

namespace App\Http\Controllers;

use App\City;
use App\Events\User\ProfileEdited;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('settings', [
            'profile' => $request->user()->profile,
            'user' => $request->user(),
            'cities' => City::all()->pluck('name', 'slug'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'sometimes|max:2048|mimes:jpeg,bmp,png',
        ]);

        $profile = $request->user()->profile;

        if ($request->has('avatar')) {
            $profile->avatar = $request->avatar->store('avatars', 'public');
        }

        $oldData = $profile->toArray();

        $profile->fill($request->except('city_id'));

        $profile->user->city_id = $request->get('city_id');

        $profile->notify_new_offer = $request->get('notify_new_offer', false);
        $profile->notify_new_transaction = $request->get('notify_new_transaction', false);

        $profile->save();
        $profile->user->save();

        $newData = $profile->toArray();

        event(new ProfileEdited($request->user()->id, $oldData, $newData));

        session()->flash('message', [
            'text' => __('common.write_success'),
        ]);

        return back();
    }

    public function show(Request $request, $user = null)
    {
        if ($user) {
            $user = User::where('name', $user)->firstOrFail();
        }

        if (!$user) {
            $user = $request->user();
        }

        if (!$user) {
            abort(404);
        }

        $offers = $user->offers()->with('game')->active()->get();

        $background = $offers->map(function ($offer) {
            return $offer->game->background;
        })->shuffle()->first();

        return view('users.profile', [
            'user' => $user,
            'reviews' => $user->reviews()->orderBy('created_at', 'desc')->paginate(5),
            'offers' => $offers,
            'background' => $background
        ]);
    }
}
