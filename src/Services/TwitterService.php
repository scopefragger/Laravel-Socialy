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
    private $user;
    private $fetch;
    private $twitter;

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
        $data = $this->process($data);
    }

    public function authorise()
    {
        try {
            $this->twitter = new TwitterAPIExchange($this->settings());
        } catch (Exception $e) {
            return $e->getTraceAsString();
        }
    }

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

    public function fetch($param, $url)
    {
        try {
            return $this->twitter->setGetfield($param)->buildOauth($url, 'GET')->performRequest();
        } catch (Exception $e) {
            return $e->getTraceAsString();
        }
    }

    public function process($data)
    {
        foreach ($data as $key => $value) {
            $this->save($value);
        }
    }

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

    public function clense($data)
    {
        $data = json_decode($data);
        return $data;
    }

}