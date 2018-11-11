<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('welcome');

Auth::routes();

Route::get('/offers', 'OfferController@index')->name('offers.index');
Route::get('/offers', 'OfferController@index')->name('offers.index');
Route::get('/offers/create', 'OfferController@create')->name('offers.create');
Route::post('/offers/create', 'OfferController@store')->name('offers.store');
Route::get('/offers/show/{offer},{slug}', 'OfferController@show')->name('offers.show');

Route::post('/query/game', 'AjaxController@game')->name('ajax.game');
Route::post('/query/platforms', 'AjaxController@platforms')->name('ajax.platforms');

Route::middleware(['auth'])->group(function () {
    Route::get('/settings', 'ProfileController@index')->name('settings.index');
    Route::patch('/settings', 'ProfileController@update')->name('settings.update');
});

Route::get('exit', 'Auth\LoginController@logout')->name('exit');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
Route::get('/transactions', 'TransactionController@index')->name('transactions.index');
Route::post('/transactions', 'TransactionController@create')->name('transactions.create');
Route::get('/reviews', 'HomeController@reviews')->name('reviews.index');
Route::get('/chat', 'HomeController@chat')->name('chat.index');
Route::get('/users', 'HomeController@users')->name('users.index');


Route::middleware(['disable_production'])->group(function () {

});


