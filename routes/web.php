<?php

Route::get('/', function () {
    return redirect()->route('landing');
});

Route::get('/login', [
    'as' => 'login',
    'uses' => 'Authentication@getLogin',
]);

Route::get('/login/verify', [
    'as' => 'login.verify',
    'uses' => 'Authentication@getVerify',
]);

Route::get('/logout', [
    'as' => 'logout',
    'uses' => 'Authentication@getLogout',
]);

Route::group(['namespace' => 'Site'], function () {
    Route::get('/landing', [
        'as'   => 'landing',
        'uses' => 'Landing@getLanding',
        'middleware' => ['voting.enabled'],
    ]);

    Route::group(['prefix' => '/account', 'as' => 'account.', 'middleware' => ['auth']], function () {
        Route::post('/subscribe', [
            'as'   => 'subscribe',
            'uses' => 'Account@postSubscribe',
        ]);

        Route::post('/unsubscribe/{code?}', [
            'as'   => 'unsubscribe',
            'uses' => 'Account@postUnsubscribe',
        ]);
    });

    Route::group(['prefix' => '/voting', 'as' => 'voting.', 'middleware' => ['auth', 'voting.enabled']], function () {
        Route::get('/', [
            'as' => 'list',
            'uses' => 'Voting@getIndex',
        ]);

        Route::post('/cast/{type}/{airfield}', [
            'as' => 'cast',
            'uses' => 'Voting@postCast',
        ]);
    });

    Route::get('/welcome', function () {
        return view('welcome');
    });
});


Route::group(['namespace' => 'Admin', 'middleware' => ['auth.admin'], 'as' => 'admin.', 'prefix' => '/admin'], function () {
    Route::get('/', [
        'as' => 'dashboard',
        'uses' => 'Dashboard@getDashboard',
    ]);

    Route::group(['as' => 'airports.', 'prefix' => '/airports'], function () {
        Route::get('/', [
            'as' => 'index',
            'uses' => 'Airports@getIndex',
        ]);
    });

    Route::group(['as' => 'flights.', 'prefix' => '/flights'], function () {
        Route::get('/', [
            'as' => 'index',
            'uses' => 'Flights@getIndex',
        ]);
    });

    Route::group(['as' => 'bookings.', 'prefix' => '/bookings'], function () {
        Route::get('/', [
            'as' => 'index',
            'uses' => 'Bookings@getIndex',
        ]);
    });

    Route::group(['as' => 'routes.', 'prefix' => '/routes'], function () {
        Route::get('/', [
            'as' => 'index',
            'uses' => 'Routes@getIndex',
        ]);
    });

    Route::group(['as' => 'users.', 'prefix' => '/users'], function () {
        Route::get('/', [
            'as' => 'index',
            'uses' => 'Users@getIndex',
        ]);
    });

    Route::group(['as' => 'settings.', 'prefix' => '/settings'], function () {
        Route::get('/', [
            'as' => 'index',
            'uses' => 'Settings@getIndex',
        ]);

        Route::post('/update', [
            'as' => 'update',
            'uses' => 'Settings@postUpdate',
        ]);
    });
});
