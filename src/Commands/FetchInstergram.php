<?php

namespace Scopefragger\LaravelSocialy\Commands;

use App\DripEmailer;
use Illuminate\Console\Command;
use Scopefragger\LaravelSocialy\Services\InstagramService;
use Scopefragger\LaravelSocialy\Services\TwitterService;

class FetchInstergram extends Command
{
    protected $signature = 'social:fetch-instagram';

    protected $description = 'Fetches Fresh instagram';


    public function handle()
    {
        $insagram = new InstagramService();
        $insagram->get();
    }
}