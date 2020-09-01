<?php

namespace MasterDmx\L2ppIntegration;

use Illuminate\Support\ServiceProvider;
use MasterDmx\L2ppIntegration\Core\Repository;
use MasterDmx\L2ppIntegration\Core\Integration;
use MasterDmx\L2ppIntegration\Repositories\Geo\CitiesRepository;

class L2ppIntegrationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        $this->publishes([
            __DIR__.'/../migrations' => database_path('migrations'),
        ], 'media');
    }

    public function register()
    {
        $this->mergeConfigFrom( __DIR__.'/../config/l2pp.php', 'l2pp');

        $this->app->singleton(Integration::class, function ($app) {
            return new Integration(
                config('l2pp.api_url'),
                config('l2pp.api_version'),
                config('l2pp.project_id'),
                config('l2pp.project_token')
            );
        });
    }
}
