<?php

namespace Scopefragger\LaravelSocialy\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class Install.
 *
 * Installs the Tables needed,  as well as running
 * the basic FBFeed Fetch's
 */
class Install extends Command
{
    /** @var string - Command Name */
    protected $name = 'social:install';

    /** @var string - Command Description */
    protected $description = 'Installs the tables for social';

    /**
     * Create a new Install command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Installs migrations via command line.
     *
     * Creates missing tables and populates them with basic data
     */
    public function fire()
    {
        if (!Schema::hasTable('laravel_socialy')) {
            Schema::create('laravel_socialy', function (Blueprint $table) {
                $table->increments('id');
                $table->string('fkey')->nullable();
                $table->string('social_site')->defalt('custom');
                $table->string('message')->nullable();
                $table->string('message')->nullable();
                $table->string('user_avatar')->nullable();
                $table->string('user_handle')->nullable();
                $table->string('user_formal_name')->nullable();
                $table->boolean('published')->nullable();
                $table->datetime('datetime')->nullable();
                $table->softDeletes();
                $table->timestamps();
            });
        }
    }
}
