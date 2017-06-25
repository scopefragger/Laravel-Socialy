<?php

namespace Scopefragger\LaravelSocialy;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Scopefragger\LaravelSocialy\Commands\FetchTweets;
use Scopefragger\LaravelSocialy\Commands\PurgeSocial;

/**
 * Class LaravelSocialyServiceProvider
 *
 * @category Awesomeness
 * @package  Larave-Socialy
 * @author   Mark Jones <mark@kitkode.co.uk>
 * @license  MIT License
 * @version  1.0.1
 * @link     https://github.com/scopefragger/Laravel-Socialy
 */
class LaravelSocialyServiceProvider extends ServiceProvider
{
    public function boot()
    {

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        if ($this->app->runningInConsole()) {
            $this->commands([
                FetchTweets::Class,
                PurgeSocial::Class
            ]);
        }

        $this->publishes([
            __DIR__ . '/Config/config.php' => config_path('socialy.php'),
        ], 'socialy');
    }
}
