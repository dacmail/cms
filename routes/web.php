<?php

Route::group(['as' => 'web::', 'namespace' => 'Web', 'middleware' => ['checkInstallation', 'redirectIfHasDomain']], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'WebController@index']);

    Route::get('/custom_css', ['as' => 'custom_css', 'uses' => 'WebController@custom_css']);

    Route::group(['as' => 'animals::', 'namespace' => 'Animals'], function () {
        Route::group(['prefix' => trans_choice('routes.animals', 2)], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'AnimalsController@index']);
        });

        Route::group(['prefix' => trans_choice('routes.animals', 1)], function () {
            Route::get('/{id}', ['as' => 'show', 'uses' => 'AnimalsController@show']);
            Route::post('/{id}/contact', ['as' => 'contact', 'uses' => 'AnimalsController@contact']);
        });
    });

    Route::group(['as' => 'posts::', 'namespace' => 'Posts'], function () {
        Route::group(['prefix' => trans_choice('routes.posts', 1)], function () {
            Route::get('/{id}-{slug}', ['as' => 'show', 'uses' => 'PostsController@show']);
        });

        Route::group(['prefix' => trans_choice('routes.posts', 2)], function () {
            Route::get(trans('routes.author') . '/{id}', ['as' => 'author', 'uses' => 'PostsController@author']);
            Route::get(trans_choice('routes.categories', 1) . '/{id}-{slug}', ['as' => 'category', 'uses' => 'PostsController@category']);
        });
    });

    Route::group(['prefix' => trans_choice('routes.pages', 1), 'as' => 'pages::', 'namespace' => 'Pages'], function () {
        Route::get('/{id}-{slug}', ['as' => 'show', 'uses' => 'PagesController@show']);
    });

    Route::group(['prefix' => trans_choice('routes.forms', 1), 'as' => 'forms::', 'namespace' => 'Forms'], function () {
        Route::get('/{id}-{slug}', ['as' => 'show', 'uses' => 'FormsController@show']);
        Route::post('/{id}', ['as' => 'send', 'uses' => 'FormsController@send']);
    });
});

Route::get('/images/animal/{id}/photo/{photo}', ['as' => 'animals::photo', 'uses' => 'ResponseFilesController@animal_photo']);
Route::get('/uploads/{file}', ['as' => 'web::upload', 'uses' => 'ResponseFilesController@web_file_upload']);
Route::get('/images/{file}', ['as' => 'web::image', 'uses' => 'ResponseFilesController@web_image']);
