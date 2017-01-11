<?php

Route::group(['prefix' => 'design',  'as' => 'design::', 'namespace' => 'Design', 'middleware'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'DesignController@index']);
    Route::get('/config', ['as' => 'config', 'uses' => 'DesignController@config']);
    Route::put('/', ['as' => 'update', 'uses' => 'DesignController@update']);
    Route::put('/config', ['as' => 'config::update', 'uses' => 'DesignController@config_update']);
    Route::get('/css', ['as' => 'css', 'uses' => 'DesignController@css']);
    Route::put('/css', ['as' => 'css::update', 'uses' => 'DesignController@css_update']);

    Route::group(['prefix' => 'widgets', 'as' => 'widgets::'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'WidgetsController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'WidgetsController@create']);
        Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'WidgetsController@edit']);
        Route::put('/{id}', ['as' => 'update', 'uses' => 'WidgetsController@update']);
        Route::post('/', ['as' => 'store', 'uses' => 'WidgetsController@store']);
        Route::get('/deleted', ['as' => 'deleted', 'uses' => 'WidgetsController@deleted']);
        Route::get('/{id}/restore', ['as' => 'restore', 'uses' => 'WidgetsController@restore']);
        Route::get('/{id}/delete', ['as' => 'delete', 'uses' => 'WidgetsController@delete']);
        Route::get('/{id}/delete-translation', ['as' => 'delete_translation', 'uses' => 'WidgetsController@delete_translation']);
    });
});
