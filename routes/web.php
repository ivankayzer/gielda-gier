<?php

Route::get('/', 'HomeController@index')->name('welcome');
Route::get('/strona-glowna', 'HomeController@index')->name('home');

Route::get('/uzytkownik/{user}', 'ProfileController@show')->name('profile.show');
Route::get('wyloguj-sie', 'Auth\LoginController@logout')->name('exit');

Route::get('/ogloszenia', 'OfferController@index')->name('offers.index');
Route::get('/ogloszenia/ogloszenie/{offer},{slug}', 'OfferController@show')->name('offers.show');

Route::post('/szukaj/gry', 'AjaxController@game')->name('ajax.game');
Route::post('/szukaj/platformy', 'AjaxController@platforms')->name('ajax.platforms');

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

Route::middleware(['auth'])->group(function () {
    Route::get('/ustawienia', 'ProfileController@index')->name('settings.index');
    Route::patch('/ustawienia', 'ProfileController@update')->name('settings.update');
    Route::get('/powiadomienia', 'HomeController@dashboard')->name('dashboard');
    Route::get('/transakcje', 'TransactionController@index')->name('transactions.index');
    Route::post('/transakcje', 'TransactionController@create')->name('transactions.create');
    Route::get('/transakcje/{transaction}/zaakceptuj', 'TransactionController@accept')->name('transactions.accept');
    Route::get('/transakcje/{transaction}/odzruc', 'TransactionController@decline')->name('transactions.decline');
    Route::post('/transakcje/ocen', 'TransactionController@rate')->name('transactions.rate');
    Route::get('/moj-profil', 'ProfileController@me')->name('profile.me');
    Route::get('/transakcja/{transaction}/info', 'TransactionController@showInfo')->name('transactions.info');
    Route::get('/czat', 'ChatController@index')->name('chat.index');
    Route::post('/czat', 'ChatController@message')->name('chat.message');
    Route::post('/czat/przeczytaj', 'ChatController@read')->name('chat.read');
    Route::get('/moje-ogloszenia', 'OfferController@my')->name('my-offers.index');
    Route::get('/moje-ogloszenia/dodaj', 'OfferController@create')->name('offers.create');
    Route::post('/moje-ogloszenia/dodaj', 'OfferController@store')->name('offers.store');
    Route::get('/moje-ogloszenia/{offer}/edytuj', 'OfferController@edit')->name('offers.edit');
    Route::post('/moje-ogloszenia/{offer}/edytuj', 'OfferController@update')->name('offers.update');
    Route::get('/moje-ogloszenia/{offer}/usun', 'OfferController@delete')->name('offers.delete');
});

Route::middleware(['disable_production'])->group(function () {

});

Route::group(['prefix' => 'admin'], function () {
});
