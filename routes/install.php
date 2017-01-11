<?php

Route::group(['as' => 'install::', 'namespace' => 'Install', 'prefix' => 'install', 'middleware' => ['redirectIfInstalled']], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'InstallController@index']);
    Route::get('/data', ['as' => 'data', 'uses' => 'InstallController@data']);
    Route::post('/data', ['as' => 'data_post', 'uses' => 'InstallController@data_post']);
    Route::get('/design', ['as' => 'design', 'uses' => 'InstallController@design']);
    Route::post('/design', ['as' => 'design_post', 'uses' => 'InstallController@design_post']);
    Route::get('/terms', ['as' => 'terms', 'uses' => 'InstallController@terms']);
    Route::post('/terms', ['as' => 'terms_post', 'uses' => 'InstallController@terms_post']);
    Route::get('/finish', ['as' => 'finish', 'uses' => 'InstallController@finish']);
});
