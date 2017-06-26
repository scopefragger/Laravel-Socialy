<?php
namespace Scopefragger\LaravelSocialy\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


/**
 * Class PurgeSocial
 *
 * Artisan command for compleatly emptying the social table
 *
 * @category Awesomeness
 * @package  Larave-Socialy
 * @author   Mark Jones <mark@kitkode.co.uk>
 * @license  MIT License
 * @version  1.0.1
 * @link     https://github.com/scopefragger/Laravel-Socialy
 */
class PurgeSocial extends Command
{
    /** @var string - Command to use in Artisan */
    protected $signature = 'social:purge';

    /** @var string - Description that shows in Artisan */
    protected $description = 'Purges the social feeds';

    /**
     * emptys the laravel_socialy table
     *
     * Function runs when command ran in Artisan
     * will truncate laravel_socialy table
     */
    public function handle()
    {
        Schema::drop('laravel_socialy');
    }
}