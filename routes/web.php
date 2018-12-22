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


Route::middleware(['guest'])->group(function () {
    Route::get('zaloguj-sie', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('zaloguj-sie', 'Auth\LoginController@login');

    Route::get('zaloz-konto', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('zaloz-konto', 'Auth\RegisterController@register');

    Route::get('haslo/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('haslo/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('haslo/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('haslo/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
});

Route::get('/oferty', 'OfferController@index')->name('offers.index');
Route::get('/oferty', 'OfferController@index')->name('offers.index');
Route::get('/oferty/dodaj', 'OfferController@create')->name('offers.create');
Route::post('/oferty/dodaj', 'OfferController@store')->name('offers.store');
Route::get('/oferty/oferta/{offer},{slug}', 'OfferController@show')->name('offers.show');

Route::post('/szukaj/gry', 'AjaxController@game')->name('ajax.game');
Route::post('/szukaj/platformy', 'AjaxController@platforms')->name('ajax.platforms');

Route::middleware(['auth'])->group(function () {
    Route::get('/ustawienia', 'ProfileController@index')->name('settings.index');
    Route::patch('/ustawienia', 'ProfileController@update')->name('settings.update');
});

Route::get('/uzytkownik/{user}', 'ProfileController@show')->name('profile.show');
Route::get('/transakcja/{transaction}/info', 'TransactionController@showInfo')->name('transactions.info');

Route::get('/czat', 'ChatController@index')->name('chat.index');
Route::post('/czat', 'ChatController@message')->name('chat.message');
Route::post('/czat/przeczytaj', 'ChatController@read')->name('chat.read');

Route::get('wyloguj-sie', 'Auth\LoginController@logout')->name('exit');

Route::get('/strona-glowna', 'HomeController@index')->name('home');
Route::get('/powiadomienia', 'HomeController@dashboard')->name('dashboard');
Route::get('/transakcje', 'TransactionController@index')->name('transactions.index');
Route::post('/transakcje', 'TransactionController@create')->name('transactions.create');
Route::get('/transakcje/{transaction}/zaakceptuj', 'TransactionController@accept')->name('transactions.accept');
Route::get('/transakcje/{transaction}/odzruc', 'TransactionController@decline')->name('transactions.decline');
Route::post('/transakcje/ocen', 'TransactionController@rate')->name('transactions.rate');
Route::get('/komentarze', 'HomeController@reviews')->name('reviews.index');
Route::get('/uzytkownicy', 'HomeController@users')->name('users.index');


Route::middleware(['disable_production'])->group(function () {

});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
