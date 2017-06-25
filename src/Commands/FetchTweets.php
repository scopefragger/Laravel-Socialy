<?php
namespace Scopefragger\LaravelSocialy\Commands;

use App\User;
use App\DripEmailer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Scopefragger\LaravelSocialy\Services\TwitterService;

class FetchTweets extends Command
{
    protected $signature = 'social:fetch-twitter';
    protected $description = 'Fetches Fresh Tweets';

    public function handle()
    {
        $twitter = new TwitterService();
        $twitter->get();
    }
}