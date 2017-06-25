<?php

namespace Scopefragger\LaravelSocialy\Services;

use Scopefragger\LaravelSocialy\Models\Social;

/**
 * Class TwitterService
 *
 * @category Awesomeness
 * @package  Larave-Socialy
 * @author   Mark Jones <mark@kitkode.co.uk>
 * @license  MIT License
 * @version  1.0.1
 * @link     https://github.com/scopefragger/Laravel-Socialy
 */
class TwitterService
{
    /** @var  - The user to collect the tweets from */
    private $user;

    /** @var  - Cunmber of tweets to fetch */
    private $fetch;

    /** @var  - The twitter object */
    private $twitter;

    /**
     * TwitterService constructor.
     */
    public function __construct()
    {
        $this->user = env('TWITTER_USER_NAME');
        $this->fetch = env('TWITTER_DEFAULT_FETCH_COUNT', '5');
    }

    /**
     * Main function for the Twitter Class
     * Fetches tweets
     * ------------------------------------
     * @return mixed
     */
    public function get()
    {
        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $param = '?screen_name=' . $this->user . '&count=' . $this->fetch;
        $this->authorise();
        $data = $this->fetch($param, $url);
        $data = $this->clense($data);
        $this->process($data);
    }

    /**
     * Creates OAuth Token handshake with twitter
     *
     * @return void
     */
    public function authorise()
    {
        try {
            $this->twitter = new TwitterAPIExchange($this->settings());
        } catch (Exception $e) {
            return $e->getTraceAsString();
        }
    }

    /**
     * Collects settings from env();
     *
     * @return array
     */
    public function settings()
    {
        $settings = [
            'oauth_access_token' => env('TWITTER_TOKEN'),
            'oauth_access_token_secret' => env('TWITTER_TOKEN_SECRET'),
            'consumer_key' => env('TWITTER_CONSUMER_KEY'),
            'consumer_secret' => env('TWITTER_COMSUPER_SECRET')
        ];
        return $settings;
    }

    /**
     * Fetches the Tweets
     *
     * Collects all of the most recent tweets for the given
     * user,  using the API details provided.
     *
     * @param $param
     * @param $url
     * @return string
     */
    public function fetch($param, $url)
    {
        try {
            return $this->twitter->setGetfield($param)->buildOauth($url, 'GET')->performRequest();
        } catch (Exception $e) {
            return $e->getTraceAsString();
        }
    }

    /**
     * Loops Though Data and process
     *
     * @param $data
     */
    public function process($data)
    {
        foreach ($data as $value) {
            $this->save($value);
        }
    }

    /**
     * Saves new / updates old tweet
     *
     * Accepts a single json entity from the twitter API
     * and saves is as either a new or updates an old tweet
     *
     * @param $data
     */
    public function save($data)
    {
        if (!empty($data->id)) {
            $social = Social::firstOrCreate(['fkey' => $data->id]);
            $social->fkey = $data->id;
            $social->social_site = 'twitter';
            $social->message = $data->text;
            $social->user_handle = $data->user->screen_name;
            $social->user_formal_name = $data->user->name;
            $social->user_avatar = $data->user->profile_image_url;
            $social->save();
        }
    }

    /**
     * Clenses Twitter JSON
     *
     * @param $data
     * @return mixed
     */
    public function clense($data)
    {
        $data = json_decode($data);
        return $data;
    }

}