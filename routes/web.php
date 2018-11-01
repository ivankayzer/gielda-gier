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

Route::middleware(['auth'])->group(function () {
    Route::get('/settings', 'ProfileController@index')->name('settings.index');
    Route::patch('/settings', 'ProfileController@update')->name('settings.update');
});

Route::get('exit', 'Auth\LoginController@logout')->name('exit');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
Route::get('/offers', 'HomeController@offers')->name('offers.index');
Route::get('/transactions', 'HomeController@transactions')->name('transactions.index');
Route::get('/reviews', 'HomeController@reviews')->name('reviews.index');
Route::get('/chat', 'HomeController@chat')->name('chat.index');
Route::get('/users', 'HomeController@users')->name('users.index');


Route::middleware(['disable_production'])->group(function () {

});


