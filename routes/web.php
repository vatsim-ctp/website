<?php

Route::get('/', function () {
    return redirect()->route('landing');
});

Route::get('/login', [
    'as' => 'login',
    'uses' => "Site\Authentication@getLogin",
]);

Route::get('/login/verify', [
    'as' => 'login.verify',
    'uses' => "Site\Authentication@getVerify",
]);

Route::get('/landing', [
    'as'   => 'landing',
    'uses' => "Site\Landing@getLanding",
    'middleware' => ['voting.enabled'],
]);

Route::post('/newsletter/subscribe', [
    'as'   => 'newsletter.subscribe',
    'uses' => "Site\Newsletter@postSubscribe",
]);

Route::group(['prefix' => '/voting', 'as' => 'voting.', 'middleware' => ['auth', 'voting.enabled']], function () {
    Route::get('/', [
        'as' => 'list',
        'uses' => "Site\Voting@getIndex",
    ]);

    Route::post('/cast/{type}/{airfield}', [
        'as' => 'cast',
        'uses' => "Site\Voting@postCast",
    ]);
});

Route::get('/welcome', function () {
    return view('welcome');
});
