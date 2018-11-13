<?php

namespace App\Http\Controllers;

use App\City;
use App\Profile;
use App\Services\SentenceComposer;
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
        $cities = City::all()->pluck('name', 'slug');

        return view('settings', [
            'profile' => $request->user()->profile,
            'user' => $request->user(),
            'cities' => $cities,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $profile = $request->user()->profile;

        if ($request->has('avatar')) {
            $profile->avatar = $request->avatar->store('avatars', 'public');
        }

        $profile->fill($request->only([
            'name',
            'surname',
            'phone',
            'address',
            'city',
            'zip',
            'description',
            'bank_nr',
            'company_name',
        ]))->save();

        session()->flash('message', [
            'text' => __('common.write_success'),
        ]);

        return back();
    }

    public function show(User $user)
    {
        return view('users.profile', [
            'user' => $user,
            'offers' => $user->offers()->active()->get()
        ]);
    }
}
