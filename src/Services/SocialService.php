<?php

namespace Scopefragger\LaravelSocialy\Services;

/**
 * Class SocialService
 *
 * @category Awesomeness
 * @package  Larave-Socialy
 * @author   Mark Jones <mark@kitkode.co.uk>
 * @license  MIT License
 * @version  1.0.2
 * @link     https://github.com/scopefragger/Laravel-Socialy
 */
class SocialService
{
    /** @var $user - The user to collect the posts from */
    public $user;

    /** @var $fetch - Number of posts to fetch */
    public $fetch = 5;

    /** @var $api - The instance of the Social Sites APIt */
    public $api;

    /** @vars $data - Data returned from API */
    public $data;

    /**
     * Wrapper for collecting new posts
     *
     * @return void
     */
    public function get()
    {
        $this->authorise();
        $this->fetch();
        $this->clean();
        $this->process();
    }

}