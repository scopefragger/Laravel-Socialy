<?php

namespace Scopefragger\LaravelSocialy\Services;

use Exception;
use Facebook\Facebook;
use Facebook\FacebookApp;
use Facebook\FacebookRequest;
use Scopefragger\LaravelSocialy\Services\Api\InstagramAPI;
use Scopefragger\LaravelSocialy\Models\Social;

class FacebookService
{

    public function authorise()
    {
        $fb = new \Facebook\Facebook([
            'app_id' => '111785185532711',
            'app_secret' => '27a9741468ecd9c6575fb50b6d9c1537',
            'default_graph_version' => 'v2.9',
        ]);
        $helper = $fb->getRedirectLoginHelper();
        $accessToken = $helper->getAccessToken();
        $response = $fb->get('/me', $accessToken);
        dd($response);
    }

    public function fetch()
    {
        try {
            return $this->data = $this->instagram->getUserMedia('self', 5);
        } catch (Exception $e) {
            return $e->getTraceAsString();
        }
    }

    public function process()
    {
        if (!empty($this->data)) {
            foreach ($this->data as $value) {
                $this->save($value);
            }
        } else {
            throw new Exception('No data passed to process');
        }
    }

    public function save($data)
    {

        if (!empty($data->id)) {
            try {

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

            } catch (Exception $e) {
                return $e->getTraceAsString();
            }
        } else {
        }
    }
}