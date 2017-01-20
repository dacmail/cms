<?php

Route::group(['prefix' => 'panel',  'as' => 'panel::', 'namespace' => 'Panel', 'middleware'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'PanelController@index']);
    Route::get('/stats', ['as' => 'stats', 'uses' => 'PanelController@stats']);

    Route::group(['prefix' => 'web', 'as' => 'webs::', 'namespace' => 'Webs'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'WebsController@index']);
        Route::put('/', ['as' => 'update', 'uses' => 'WebsController@update']);
    });

    Route::group(['prefix' => 'users', 'as' => 'users::', 'namespace' => 'Users'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'UsersController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'UsersController@create']);
        Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'UsersController@edit']);
        Route::put('/{id}', ['as' => 'update', 'uses' => 'UsersController@update']);
        Route::post('/', ['as' => 'store', 'uses' => 'UsersController@store']);
        Route::post('/notifications/read', ['as' => 'read_notifications', 'uses' => 'UsersController@read_notifications']);
        Route::get('/{id}/delete', ['as' => 'delete', 'uses' => 'UsersController@delete']);
        Route::get('/{id}', ['as' => 'show', 'uses' => 'UsersController@show']);
    });

    Route::group(['prefix' => 'partners', 'as' => 'partners::', 'namespace' => 'Partners'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'PartnersController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'PartnersController@create']);
        Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'PartnersController@edit']);
        Route::put('/{id}', ['as' => 'update', 'uses' => 'PartnersController@update']);
        Route::post('/', ['as' => 'store', 'uses' => 'PartnersController@store']);
        Route::get('/deleted', ['as' => 'deleted', 'uses' => 'PartnersController@deleted']);
        Route::get('/{id}/restore', ['as' => 'restore', 'uses' => 'PartnersController@restore']);
        Route::get('/{id}/delete', ['as' => 'delete', 'uses' => 'PartnersController@delete']);
        Route::get('/{id}', ['as' => 'show', 'uses' => 'PartnersController@show']);
    });

    Route::group(['prefix' => 'veterinarians', 'as' => 'veterinarians::', 'namespace' => 'Veterinarians'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'VeterinariansController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'VeterinariansController@create']);
        Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'VeterinariansController@edit']);
        Route::put('/{id}', ['as' => 'update', 'uses' => 'VeterinariansController@update']);
        Route::post('/', ['as' => 'store', 'uses' => 'VeterinariansController@store']);
        Route::get('/deleted', ['as' => 'deleted', 'uses' => 'VeterinariansController@deleted']);
        Route::get('/{id}/restore', ['as' => 'restore', 'uses' => 'VeterinariansController@restore']);
        Route::get('/{id}/delete', ['as' => 'delete', 'uses' => 'VeterinariansController@delete']);
        Route::get('/{id}', ['as' => 'show', 'uses' => 'VeterinariansController@show']);
    });

    Route::group(['prefix' => 'animals', 'as' => 'animals::', 'namespace' => 'Animals'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'AnimalsController@index']);
        Route::get('/deleted', ['as' => 'deleted', 'uses' => 'AnimalsController@deleted']);
        Route::get('/create', ['as' => 'create', 'uses' => 'AnimalsController@create']);
        Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'AnimalsController@edit']);
        Route::put('/{id}', ['as' => 'update', 'uses' => 'AnimalsController@update']);
        Route::post('/', ['as' => 'store', 'uses' => 'AnimalsController@store']);
        Route::get('/{id}/restore', ['as' => 'restore', 'uses' => 'AnimalsController@restore']);
        Route::get('/{id}/delete', ['as' => 'delete', 'uses' => 'AnimalsController@delete']);
        Route::get('/{id}/delete-translation', ['as' => 'delete_translation', 'uses' => 'AnimalsController@delete_translation']);

        Route::group(['prefix' => '{animal_id}/photos', 'as' => 'photos::'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'PhotosController@index']);
            Route::post('/', ['as' => 'store', 'uses' => 'PhotosController@store']);
            Route::get('/{id}/main', ['as' => 'main', 'uses' => 'PhotosController@main']);
            Route::get('/{id}/delete', ['as' => 'delete', 'uses' => 'PhotosController@delete']);
        });

        Route::group(['prefix' => '{animal_id}/health', 'as' => 'health::'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'HealthController@index']);
            Route::get('/create', ['as' => 'create', 'uses' => 'HealthController@create']);
            Route::post('/', ['as' => 'store', 'uses' => 'HealthController@store']);
            Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'HealthController@edit']);
            Route::put('/{id}', ['as' => 'update', 'uses' => 'HealthController@update']);
            Route::get('/{id}/delete', ['as' => 'delete', 'uses' => 'HealthController@delete']);
        });

        Route::group(['prefix' => '{animal_id}/sponsorships', 'as' => 'sponsorships::'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'SponsorshipsController@index']);
            Route::get('/create', ['as' => 'create', 'uses' => 'SponsorshipsController@create']);
            Route::post('/', ['as' => 'store', 'uses' => 'SponsorshipsController@store']);
            Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'SponsorshipsController@edit']);
            Route::put('/{id}', ['as' => 'update', 'uses' => 'SponsorshipsController@update']);
            Route::get('/{id}/delete', ['as' => 'delete', 'uses' => 'SponsorshipsController@delete']);
        });

        Route::group(['prefix' => '{id}/export', 'as' => 'export::'], function () {
            Route::get('/pdf', ['as' => 'pdf', 'uses' => 'ExportController@pdf']);
            Route::get('/word', ['as' => 'word', 'uses' => 'ExportController@word']);
        });

        Route::get('/{id}', ['as' => 'show', 'uses' => 'AnimalsController@show']);
    });

    Route::group(['prefix' => 'temporaryhomes', 'as' => 'temporaryhomes::', 'namespace' => 'Animals'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'TemporaryHomesController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'TemporaryHomesController@create']);
        Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'TemporaryHomesController@edit']);
        Route::put('/{id}', ['as' => 'update', 'uses' => 'TemporaryHomesController@update']);
        Route::post('/', ['as' => 'store', 'uses' => 'TemporaryHomesController@store']);
        Route::get('/deleted', ['as' => 'deleted', 'uses' => 'TemporaryHomesController@deleted']);
        Route::get('/{id}/restore', ['as' => 'restore', 'uses' => 'TemporaryHomesController@restore']);
        Route::get('/{id}/delete', ['as' => 'delete', 'uses' => 'TemporaryHomesController@delete']);
        Route::get('/{id}', ['as' => 'show', 'uses' => 'TemporaryHomesController@show']);
    });

    Route::group(['prefix' => 'posts', 'as' => 'posts::', 'namespace' => 'Posts'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'PostsController@index']);
        Route::get('/deleted', ['as' => 'deleted', 'uses' => 'PostsController@deleted']);
        Route::get('/create', ['as' => 'create', 'uses' => 'PostsController@create']);
        Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'PostsController@edit']);
        Route::put('/{id}', ['as' => 'update', 'uses' => 'PostsController@update']);
        Route::post('/', ['as' => 'store', 'uses' => 'PostsController@store']);
        Route::post('/{id}', ['as' => 'restore', 'uses' => 'PostsController@restore']);
        Route::get('/{id}/restore', ['as' => 'restore', 'uses' => 'PostsController@restore']);
        Route::get('/{id}/delete', ['as' => 'delete', 'uses' => 'PostsController@delete']);
        Route::get('/{id}/delete-translation', ['as' => 'delete_translation', 'uses' => 'PostsController@delete_translation']);
        Route::get('/{id}', ['as' => 'show', 'uses' => 'PostsController@show']);
    });

    Route::group(['prefix' => 'pages', 'as' => 'pages::', 'namespace' => 'Pages'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'PagesController@index']);
        Route::get('/deleted', ['as' => 'deleted', 'uses' => 'PagesController@deleted']);
        Route::get('/create', ['as' => 'create', 'uses' => 'PagesController@create']);
        Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'PagesController@edit']);
        Route::put('/{id}', ['as' => 'update', 'uses' => 'PagesController@update']);
        Route::post('/', ['as' => 'store', 'uses' => 'PagesController@store']);
        Route::post('/{id}', ['as' => 'restore', 'uses' => 'PagesController@restore']);
        Route::get('/{id}/restore', ['as' => 'restore', 'uses' => 'PagesController@restore']);
        Route::get('/{id}/delete', ['as' => 'delete', 'uses' => 'PagesController@delete']);
        Route::get('/{id}/delete-translation', ['as' => 'delete_translation', 'uses' => 'PagesController@delete_translation']);
        Route::get('/{id}', ['as' => 'show', 'uses' => 'PagesController@show']);
    });

    Route::group(['prefix' => 'forms', 'as' => 'forms::', 'namespace' => 'Forms'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'FormsController@index']);
        Route::get('/deleted', ['as' => 'deleted', 'uses' => 'FormsController@deleted']);
        Route::get('/create', ['as' => 'create', 'uses' => 'FormsController@create']);
        Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'FormsController@edit']);
        Route::put('/{id}', ['as' => 'update', 'uses' => 'FormsController@update']);
        Route::post('/', ['as' => 'store', 'uses' => 'FormsController@store']);
        Route::post('/{id}', ['as' => 'restore', 'uses' => 'FormsController@restore']);
        Route::get('/{id}/restore', ['as' => 'restore', 'uses' => 'FormsController@restore']);
        Route::get('/{id}/delete', ['as' => 'delete', 'uses' => 'FormsController@delete']);
        Route::get('/{id}/delete-translation', ['as' => 'delete_translation', 'uses' => 'FormsController@delete_translation']);
    });

    Route::group(['prefix' => 'files', 'as' => 'files::', 'namespace' => 'Files'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'FilesController@index']);
        Route::get('/deleted', ['as' => 'deleted', 'uses' => 'FilesController@deleted']);
        Route::get('/create', ['as' => 'create', 'uses' => 'FilesController@create']);
        Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'FilesController@edit']);
        Route::put('/{id}', ['as' => 'update', 'uses' => 'FilesController@update']);
        Route::post('/', ['as' => 'store', 'uses' => 'FilesController@store']);
        Route::post('/{id}', ['as' => 'restore', 'uses' => 'FilesController@restore']);
        Route::get('/{id}/restore', ['as' => 'restore', 'uses' => 'FilesController@restore']);
        Route::get('/{id}/delete', ['as' => 'delete', 'uses' => 'FilesController@delete']);
    });
});
