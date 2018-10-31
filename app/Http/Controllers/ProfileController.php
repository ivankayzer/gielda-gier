<?php

namespace App\Http\Controllers;

use App\City;
use App\Profile;
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
        $request->user()->profile->fill($request->only([
            'avatar',
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

        return back();
    }
}
