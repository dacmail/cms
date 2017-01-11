<?php

Route::group(['prefix' => 'support',  'as' => 'support::', 'namespace' => 'Support'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'SupportController@index']);
    Route::get('/faq', ['as' => 'faq', 'uses' => 'SupportController@faq']);
    Route::get('/contact', ['as' => 'contact', 'uses' => 'SupportController@contact']);
    Route::post('/contact', ['as' => 'contact_post', 'uses' => 'SupportController@contact_post']);
    Route::get('/changelog', ['as' => 'changelog', 'uses' => 'SupportController@changelog']);
});
