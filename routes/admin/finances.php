<?php

Route::group(['prefix' => 'finances',  'as' => 'finances::', 'namespace' => 'Finances'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'FinancesController@index']);
    Route::get('/stats', ['as' => 'stats', 'uses' => 'FinancesController@stats']);
    Route::get('/create', ['as' => 'create', 'uses' => 'FinancesController@create']);
    Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'FinancesController@edit']);
    Route::put('/{id}', ['as' => 'update', 'uses' => 'FinancesController@update']);
    Route::post('/', ['as' => 'store', 'uses' => 'FinancesController@store']);
    Route::get('/deleted', ['as' => 'deleted', 'uses' => 'FinancesController@deleted']);
    Route::get('/{id}/restore', ['as' => 'restore', 'uses' => 'FinancesController@restore']);
    Route::get('/{id}/delete', ['as' => 'delete', 'uses' => 'FinancesController@delete']);
    Route::get('/{id}', ['as' => 'show', 'uses' => 'FinancesController@show']);
});
