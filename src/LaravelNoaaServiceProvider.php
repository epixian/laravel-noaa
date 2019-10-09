<?php

namespace Epixian\LaravelNoaa;

use Illuminate\Support\ServiceProvider;

class LaravelNoaaServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     * 
     * @return void
     */
    public function boot()
    {
        $source = dirname(__DIR__) . '/config/noaa.php';

        $this->publishes([$source => config_path('noaa.php')], 'epixian-laravel-noaa');

        $this->mergeConfigFrom($source, 'noaa');
    }

    /**
     * Register package services.
     * 
     * @return void
     */
    public function register()
    {
        $this->app->singleton('noaa', function ($app) {
            return new Noaa();
        });
    }
}