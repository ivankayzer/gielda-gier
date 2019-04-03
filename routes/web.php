<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get('/uzytkownik/{user?}', 'ProfileController@show')->name('profile.show');
Route::get('wyloguj-sie', 'Auth\LoginController@logout')->name('exit');

Route::prefix('ogloszenia')->group(function () {
    Route::get('/', 'OfferController@index')->name('offers.index');
    Route::get('ogloszenie/{offer},{slug}', 'OfferController@show')->name('offers.show');
});

Route::prefix('szukaj')->group(function () {
    Route::get('gry', 'AjaxController@game')->name('ajax.game');
    Route::get('platformy', 'AjaxController@platforms')->name('ajax.platforms');
    Route::get('miasta', 'AjaxController@cities')->name('ajax.cities');
});

Route::middleware(['guest'])->group(function () {
    Route::prefix('zaloguj-sie')->group(function () {
        Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
        Route::post('/', 'Auth\LoginController@login');
    });

    Route::prefix('zaloz-konto')->group(function () {
        Route::get('/', 'Auth\RegisterController@showRegistrationForm')->name('register');
        Route::post('/', 'Auth\RegisterController@register');
    });

    Route::prefix('haslo')->group(function () {
        Route::get('reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('reset', 'Auth\ResetPasswordController@reset')->name('password.update');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('ustawienia')->group(function () {
        Route::get('/', 'ProfileController@index')->name('settings.index');
        Route::patch('/', 'ProfileController@update')->name('settings.update');
    });

    Route::get('/powiadomienia', 'HomeController@notifications')->name('notifications');

    Route::prefix('transakcje')->group(function () {
        Route::get('/', 'TransactionController@index')->name('transactions.index');
        Route::post('/', 'TransactionController@store')->name('transactions.create');
        Route::get('{transaction}/zaakceptuj', 'TransactionController@accept')->name('transactions.accept');
        Route::get('{transaction}/odzruc', 'TransactionController@decline')->name('transactions.decline');
        Route::post('ocen', 'TransactionController@rate')->name('transactions.rate');
    });

    Route::get('/moj-profil', 'ProfileController@show')->name('profile.me');
    Route::get('/transakcja/{transaction}/info', 'TransactionController@showInfo')->name('transactions.info');

    Route::prefix('czat')->group(function () {
        Route::get('/', 'ChatController@index')->name('chat.index');
        Route::post('/', 'ChatController@message')->name('chat.message');
        Route::post('przeczytaj', 'ChatController@read')->name('chat.read');
    });

    Route::prefix('moje-ogloszenia')->group(function () {
        Route::get('/', 'OfferController@my')->name('my-offers.index');
        Route::get('dodaj', 'OfferController@create')->name('offers.create');
        Route::post('dodaj', 'OfferController@store')->name('offers.store');
        Route::get('{offer}/edytuj', 'OfferController@edit')->name('offers.edit');
        Route::post('{offer}/edytuj', 'OfferController@update')->name('offers.update');
        Route::get('{offer}/usun', 'OfferController@delete')->name('offers.delete');
    });
});

Route::middleware(['disable_production'])->group(function () {
});

Route::group(['prefix' => 'admin'], function () {
});
