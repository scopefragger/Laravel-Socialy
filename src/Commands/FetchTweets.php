<?php

namespace Scopefragger\LaravelSocialy\Commands;

use App\User;
use App\DripEmailer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Scopefragger\LaravelSocialy\Services\TwitterService;

/**
 * Class FetchTweets
 *
 * Artisan Command for collecting new tweets and storing
 * them into the social table;
 *
 * @category Awesomeness
 * @package  Larave-Socialy
 * @author   Mark Jones <mark@kitkode.co.uk>
 * @license  MIT License
 * @version  1.0.1
 * @link     https://github.com/scopefragger/Laravel-Socialy
 */
class FetchTweets extends Command
{
    /** @var string - Command to use in Artisan */
    protected $signature = 'social:fetch-twitter';

    /** @var string - Description that shows in Artisan */
    protected $description = 'Fetches Fresh Tweets';

    /**
     * Collects all new Tweets
     *
     * Triggered when social:fetch-twitter is called via artisan,
     * Runs nessicery commands to trigger collect all new tweets
     * update recent tweets and update profile icons.
     */
    public function handle()
    {
        $twitter = new TwitterService();
        $twitter->get();
    }
}