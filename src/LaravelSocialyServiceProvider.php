<?php

namespace Scopefragger\LaravelSocialy;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Scopefragger\LaravelSocialy\Commands\FetchInstergram;
use Scopefragger\LaravelSocialy\Commands\FetchTweets;
use Scopefragger\LaravelSocialy\Commands\PurgeSocial;
use Scopefragger\LaravelSocialy\Commands\Install;

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
    public function boot(Router $router)
    {
        $this->config();
        $this->command();
        $this->migrations();
    }

    /**
     * Registers migrations with the application
     *
     * Registers all migration files within the ./Migrations
     * Dir of this package with the application for processing
     * next time artisan migrate is ran.
     *
     * @return void
     */
    public function migrations()
    {
        if (method_exists('this', 'loadMigrationsFrom')) {
            $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        }
    }

    /**
     * Registers commands with application
     *
     * Binds artisan commands to the application,  only when
     * the user is accessing the code via the artisan CLI
     *
     * return void
     */
    public function command()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                FetchTweets::Class,
                FetchInstergram::Class,
                Install::Class,
                PurgeSocial::Class
            ]);
        }
    }

    /**
     * Registers a custom config with application
     *
     * Provides the abuilty to create and manage a custom local
     * config for the package.
     *
     * return void
     */
    public function config()
    {
        $this->publishes([
            __DIR__ . '/Config/config.php' => config_path('socialy.php'),
        ], 'socialy');
    }
}
