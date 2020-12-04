<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace'  => 'MasterDmx\LaravelL2ppIntegration\Controllers',
    'prefix' => 'l2pp',
    'as' => 'l2pp.',
], function () {

    // ------------------------------------------------------------
    // Внешние эвенты
    // ------------------------------------------------------------

    Route::group(['prefix' => 'event', 'middleware' => ['web']], function () {

        // Города
        Route::get('city-updated', 'EventCityController@update');
        Route::get('city-created', 'EventCityController@create');
        Route::get('city-removed', 'EventCityController@destroy');
        Route::get('city-sync', 'EventCityController@syncAll');

        // Регионы
        Route::get('region-updated', 'EventRegionController@update');
        Route::get('region-created', 'EventRegionController@create');
        Route::get('region-removed', 'EventRegionController@destroy');
        Route::get('region-sync', 'EventRegionController@syncAll');

    });


    Route::get('test/{method}', 'TestController@init');

    // ------------------------------------------------------------
    // Media
    // ------------------------------------------------------------

    Route::get('media/{path}', 'MediaController@index')->where('path', '[a-z0-9/.]+')->name('get.media');

});
