<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace'  => 'MasterDmx\L2ppIntegration\Controllers',
    'prefix' => 'l2pp',
    'as' => 'l2pp.',
], function () {

    // ------------------------------------------------------------
    // Внешние эвенты
    // ------------------------------------------------------------

    Route::group(['prefix' => 'event'], function () {

        // Города
        Route::get('updateCity', 'EventCityController@update');
        Route::get('createCity', 'EventCityController@create');
        Route::get('destroyCity', 'EventCityController@destroy');
        Route::get('syncCities', 'EventCityController@syncAll');

        // Регионы
        Route::get('updateRegion', 'EventRegionController@update');
        Route::get('createRegion', 'EventRegionController@create');
        Route::get('destroyRegion', 'EventRegionController@destroy');
        Route::get('syncRegions', 'EventRegionController@syncAll');

    });


    Route::get('test/{method}', 'TestController@init');



});
