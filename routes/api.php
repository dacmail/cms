<?php

Route::group(['as' => 'api::', 'namespace' => 'Api', 'prefix' => 'api'], function () {
    Route::group(['as' => 'location::', 'prefix' => 'location'], function () {
        Route::get('countries/{id}/states', ['as' => 'states', 'uses' => 'LocationController@states']);
        Route::get('states/{id}/cities', ['as' => 'cities', 'uses' => 'LocationController@cities']);
    });
});
