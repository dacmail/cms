<?php

Route::get('/administracion', function () {
    return redirect()->route('admin::panel::index');
});

Route::group(['prefix' => 'admin', 'as' => 'admin::', 'namespace' => 'Admin', 'middleware' => ['auth', 'verifyAdminAccess', 'checkInstallation', 'redirectIfHasDomain']], function () {
    Route::get('/', function () {
        return redirect()->route('admin::panel::index');
    });

    require 'admin/panel.php';
    require 'admin/support.php';
    require 'admin/calendar.php';
    require 'admin/finances.php';
    require 'admin/design.php';
});
