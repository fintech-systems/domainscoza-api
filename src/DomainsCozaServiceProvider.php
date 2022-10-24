<?php

namespace FintechSystems\DomainsCoza;

use Illuminate\Support\ServiceProvider;

class DomainsCozaServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/domainscoza.php' => config_path('domainscoza.php'),
        ], 'domainscoza-config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/domainscoza.php', 'domainscoza'
        );

        $this->app->bind('domainscoza', function () {
            return new DomainsCoza([
                'url' => config('domainscoza.url'),
                'username' => config('domainscoza.username'),
                'password' => config('domainscoza.password'),
            ]);
        });
    }
}
