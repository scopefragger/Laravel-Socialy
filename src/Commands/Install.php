<?php

namespace E3Creative\LaravelSocialy\Commands;

use CreateSocial;
use E3Creative\FbFeed\Migrations\CreateFixtures;
use E3Creative\FbFeed\Migrations\CreatePlayers;
use E3Creative\FbFeed\Migrations\CreatePositions;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

/**
 * Class Install
 *
 * Installs the Tables needed,  as well as running
 * the basic FBFeed Fetch's
 *
 * @package E3Creative\FbFeed\Commands
 */
class Install extends Command
{
    /** @var string - Command Name */
    protected $name = 'social:install';

    /** @var string - Command Description */
    protected $description = 'Installs the tables for social';

    /**
     * Create a new Install command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Installs migrations via command line
     *
     * Creates missing tables and populates them with basic data
     *
     * @return void
     */
    public function fire()
    {
        if (!Schema::hasTable('laravel_socialy')) {
            $players = new CreateSocial();
            $players->up();
        }

    }

}
