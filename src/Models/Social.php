<?php
namespace Scopefragger\LaravelSocialy\Models;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    /** @var string - Tabel Name */
    protected $table = 'laravel_socialy';

    /** @var bool - Enabled Timestamps on save */
    public $timestamps = true;

    /** @var array - List of values that can be mass assigned */
    protected $fillable = [
        'message', 'social_site', 'user_avatar', 'user_handle', 'user_formal_name', 'published', 'datetime'
    ];

    /**
     * Get's latest entrys
     *
     * Grabs the most recent entrys pulled into the DB
     * regardless of there source social site,  a limit can
     * be defined and is defaulted at 10
     *
     * @param int $limit
     * @return mixed
     */
    public function latest($limit = 10)
    {
        return $this->orderBy('created_at', 'DESC')->limit($limit)->get();
    }

    /**
     * Grab's latest from specified site
     *
     * Grabs the most recent entrys from any
     * given social site,  provides functinality to
     * specify a limit
     *
     * @param string $site
     * @param int $limit
     * @return mixed
     */
    public function latestBySite($site, $limit = 10)
    {
        return $this->where('social_site', '=', $site)->orderBy('created_at', 'DESC')->limit($limit)->get();
    }

    /**
     * Gets most recent tweets
     *
     * wrapper for latestBySite,  that specifys twitter
     * as a source.
     *
     * @param $limit
     * @return mixed
     */
    public function twitter($limit)
    {
        return $this->latestBySite('twitter', $limit);
    }

    /**
     * Gets most recent FB Posts
     *
     * wrapper for latestBySite,  that specifys facebook
     * as a source.
     *
     * @param $limit
     * @return mixed
     */
    public function facebook($limit)
    {
        return $this->latestBySite('facebook', $limit);
    }

    /**
     * Gets most recent Instergram posts
     *
     * wrapper for latestBySite,  that specifys instergram
     * as a source.
     *
     * @param $limit
     * @return mixed
     */
    public function instergram($limit)
    {
        return $this->latestBySite('instaregram', $limit);
    }
}