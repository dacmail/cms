<?php

Route::group(['prefix' => 'calendar',  'as' => 'calendar::', 'namespace' => 'Calendar'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'CalendarController@index']);
    Route::get('/calendar', ['as' => 'calendar', 'uses' => 'CalendarController@calendar']);
    Route::get('/create', ['as' => 'create', 'uses' => 'CalendarController@create']);
    Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'CalendarController@edit']);
    Route::put('/{id}', ['as' => 'update', 'uses' => 'CalendarController@update']);
    Route::post('/', ['as' => 'store', 'uses' => 'CalendarController@store']);
    Route::get('/{id}/delete', ['as' => 'delete', 'uses' => 'CalendarController@delete']);
});
