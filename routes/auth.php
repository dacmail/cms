<?php

Route::group(['prefix' => 'auth', 'as' => 'auth::', 'namespace' => 'Auth', 'middleware' => ['checkInstallation']], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('login', ['as' => 'login', 'uses' => 'AuthController@login']);
        Route::get('recovery', ['as' => 'recovery', 'uses' => 'AuthController@recovery']);
        Route::post('login', ['as' => 'login_post', 'uses' => 'AuthController@login_post']);
        Route::post('recovery', ['as' => 'recovery_post', 'uses' => 'AuthController@recovery_post']);
        Route::get('password', ['as' => 'password', 'uses' => 'AuthController@password']);
        Route::post('password', ['as' => 'password_post', 'uses' => 'AuthController@password_post']);
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);
    });
});

Route::get('/login', function () {
    return redirect(route('auth::login'), 301);
});
