<?php

Route::group(['as' => 'superadmin::', 'namespace' => 'SuperAdmin', 'prefix' => 'superadmin', 'middleware' => ['superAdmin']], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'SuperAdminController@index']);
    Route::get('/analytics', ['as' => 'analytics', 'uses' => 'SuperAdminController@analytics']);
    Route::post('/set-web', ['as' => 'set_web', 'uses' => 'SuperAdminController@set_web']);

    Route::get('notifications', ['as' => 'notifications', 'uses' => 'SuperAdminController@notifications']);
    Route::post('notifications/send', ['as' => 'notifications.send', 'uses' => 'SuperAdminController@notifications_send']);

    Route::group(['prefix' => 'webs', 'as' => 'webs::', 'namespace' => 'Webs'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'WebsController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'WebsController@create']);
        Route::get('/edit', ['as' => 'edit', 'uses' => 'WebsController@edit']);
        Route::post('/', ['as' => 'store', 'uses' => 'WebsController@store']);
        Route::put('/', ['as' => 'update', 'uses' => 'WebsController@update']);
    });
});
