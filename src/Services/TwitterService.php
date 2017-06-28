<?php

namespace Scopefragger\LaravelSocialy\Services;

use League\Flysystem\Exception;
use Scopefragger\LaravelSocialy\Models\Social;
use Scopefragger\LaravelSocialy\Services\Api\TwitterAPI;

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
class TwitterService extends SocialService
{
    /** @vars $url - Constructed URL */
    private $url;

    /**
     * TwitterService constructor.
     */
    public function __construct()
    {
        $this->user = env('TWITTER_USER_NAME');
        $this->fetch = env('TWITTER_DEFAULT_FETCH_COUNT', '5');

        $this->url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $this->param = '?screen_name=' . $this->user . '&count=' . $this->fetch;
    }


    /**
     * Creates OAuth Token handshake with twitter
     *
     * @return void
     */
    public function authorise()
    {
        try {
            $this->api = new TwitterAPI($this->settings());
        } catch (Exception $e) {
            return $e->getTraceAsString();
        }
    }

    /**
     * Collects settings from env();
     *
     * @return array
     */
    private function settings()
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
    public function fetch()
    {
        try {
            return $this->data = $this->api->setGetfield($this->param)->buildOauth($this->url, 'GET')->performRequest();
        } catch (Exception $e) {
            return $e->getTraceAsString();
        }
    }

    /**
     * cleans Twitter JSON
     *
     * @return mixed
     */
    public function clean()
    {
        $this->data = json_decode($this->data);
        return $this->data;
    }


    /**
     * Loops Though Data and process
     *
     * @return void
     */
    public function process()
    {
        if (!empty($this->data)) {
            foreach ($this->data as $value) {
                $this->save($value);
            }
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

            echo "Imported Tweet " . $data->id . "\n";

            /** Check if record exists else make one */
            $social = Social::firstOrCreate(['fkey' => $data->id]);
            $social->fkey = $data->id;
            $social->social_site = 'twitter';

            /** Save Twitter Message */
            if (!empty($data->text)) {
                $social->message = $data->text;
            }

            /** Save there username `@JohnDoh` */
            if (!empty($data->user->screen_name)) {
                $social->user_handle = $data->user->screen_name;
            }

            /** Save there full name `John Doh` */
            if (!empty($data->user->name)) {
                $social->user_formal_name = $data->user->name;
            }

            /** save the url of there profile image */
            if (!empty($data->user->profile_image_url)) {
                $social->user_avatar = $data->user->profile_image_url;
            }

            /** save the object */
            $social->save();
        }
    }

}