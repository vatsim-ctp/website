<?php


Route::group(['middleware' => 'api', 'as' => 'api.', 'namespace' => 'Api'], function () {
    Route::get('status', [
        'as' => 'status',
        'uses' => 'Status@getStatus',
    ]);
});
