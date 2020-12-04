<?php

namespace MasterDmx\LaravelL2ppIntegration;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use MasterDmx\LaravelL2ppIntegration\Components\Integration;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(substr(__DIR__, 0, -4) . '/routes/web.php');

        $this->publishes([
            __DIR__.'/../migrations' => database_path('migrations'),
        ], 'media');

        $config = $this->app->make(config('l2pp.config'));

        // Регистрации компонентов медиа модуля
        $this->app->make(config('l2pp.media_manager'))->defineHandlers($config->getMediaEntities());

        // Регистрации компонентов модуля доп. аттрибутов
        $this->app->make(config('l2pp.attributes_manager'))->defineContexts($config->getAttributesContexts());
    }

    public function register()
    {
        $this->mergeConfigFrom( __DIR__.'/../config/l2pp.php', 'l2pp');

        $this->app->singleton(Integration::class, function ($app) {
            return new Integration(
                config('l2pp.url'),
                config('l2pp.api_url'),
                config('l2pp.api_version'),
                config('l2pp.project_id'),
                config('l2pp.project_token')
            );
        });

        $this->app->singleton(config('l2pp.config'));
    }
}
