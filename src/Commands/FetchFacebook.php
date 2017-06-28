<?php

namespace Scopefragger\LaravelSocialy\Commands;

use App\DripEmailer;
use Illuminate\Console\Command;
use Scopefragger\LaravelSocialy\Services\FacebookService;
use Scopefragger\LaravelSocialy\Services\TwitterService;

class FetchFacebook extends Command
{
    /** @var string - Command to use in Artisan */
    protected $signature = 'social:fetch-facebook';

    /** @var string - Description that shows in Artisan */
    protected $description = 'Fetches Fresh Facebook';

    public function handle()
    {
        $facebook = new FacebookService();
        $facebook->get();
    }
}