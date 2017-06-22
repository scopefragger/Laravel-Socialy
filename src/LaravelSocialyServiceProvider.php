<?php

namespace Scopefragger\LaravelSocialy;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class LaravelSocialyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->publishes([
            __DIR__ . '/Config/config.php' => config_path('magic-views.php'),
        ], 'magic-views');
    }
}
