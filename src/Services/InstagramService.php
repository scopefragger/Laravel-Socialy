<?php

namespace Scopefragger\LaravelSocialy\Services;

use Scopefragger\LaravelSocialy\Services\InstagramAPIExchange;
use Scopefragger\LaravelSocialy\Models\Social;

class InstagramService
{
    private $user;

    private $fetch = 5;

    private $instagram;

    public function __construct()
    {
        $this->user = env('INSTAGRAM_USER_NAME');
        $this->fetch = env('INSTAGRAM_DEFAULT_FETCH_COUNT', '5');
    }

    public function get()
    {
        $this->instagram = new InstagramAPIExchange(env('INSTAGRAM_API_KEY'));
        $this->instagram->setAccessToken(env('INSTAGRAM_ACCESS_TOKEN'));
        $data = $this->fetch();
        $data = $this->process($data->data);
    }

    public function fetch()
    {
        try {
            return $this->instagram->getUserMedia('self', 5);
        } catch (Exception $e) {
            return $e->getTraceAsString();
        }
    }

    public function process($data)
    {
        if (!empty($data)) {
            foreach ($data as $value) {
                $this->save($value);
            }
        }
    }

    public function save($data)
    {
        if (!empty($data->id)) {

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

            /** save the object */
            $social->save();
        }
    }

}