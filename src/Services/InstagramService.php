<?php

namespace Scopefragger\LaravelSocialy\Services;

use Exception;
use Scopefragger\LaravelSocialy\Services\Api\InstagramAPI;
use Scopefragger\LaravelSocialy\Models\Social;

/**
 * Class InstagramService
 *
 * @category Awesomeness
 * @package  Larave-Socialy
 * @author   Mark Jones <mark@kitkode.co.uk>
 * @license  MIT License
 * @version  1.0.1
 * @link     https://github.com/scopefragger/Laravel-Socialy
 */
class InstagramService extends SocialService
{
    /**
     * Create new InstagramService object
     */
    public function __construct()
    {
        $this->user = env('INSTAGRAM_USER_NAME');
        $this->fetch = env('INSTAGRAM_DEFAULT_FETCH_COUNT', '5');
    }

    /**
     * Creates OAuth Token handshake with Instagram
     *
     * @return void
     */
    public function authorise()
    {
        $this->api = new InstagramAPI(env('INSTAGRAM_API_KEY'));
        $this->api->setAccessToken(env('INSTAGRAM_ACCESS_TOKEN'));
    }

    /**
     * Fetches the Instagram posts
     *
     * Collects all of the most recent posts for the given
     * user,  using the API details provided.
     *
     * @return string
     */
    public function fetch()
    {
        try {
            return $this->data = $this->api->getUserMedia('self', 5);
        } catch (Exception $e) {
            return $e->getTraceAsString();
        }
    }


    /**
     * cleans Instagram API Data
     *
     * @return mixed
     */
    public function clean()
    {

    }

    public function process()
    {
        if (!empty($this->data->data)) {
            foreach ($this->data->data as $value) {
                $this->save($value);
            }
        } else {
            throw new Exception('No data passed to process');
        }
    }

    public function save($data)
    {

        if (!empty($data->id)) {

            echo "Imported Instagram Post " . $data->id . "\n";


            /** Check if record exists else make one */
            $social = Social::firstOrCreate(['fkey' => $data->id]);
            $social->fkey = $data->id;
            $social->social_site = 'instagram';

            /** Save Twitter Message */
            if (!empty($data->caption->text)) {
                $social->message = $data->caption->text;
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

            //@TODO SAVE MEDIA IMAGE

            /** save the object */
            $social->save();


        }
    }
}