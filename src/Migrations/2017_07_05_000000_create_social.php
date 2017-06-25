<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSocial
 *
 * Migration for managing the laravel_socialy table
 * utilised for all social accounts in the laravel-socialy package
 *
 * @category Awesomeness
 * @package  Larave-Socialy
 * @author   Mark Jones <mark@kitkode.co.uk>
 * @license  MIT License
 * @version  1.0.1
 * @link     https://github.com/scopefragger/Laravel-Socialy
 */
class CreateSocial extends Migration
{
    /**
     *
     */
    public function up()
    {
        Schema::create('laravel_socialy', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fkey')->nullable();
            $table->string('social_site')->default('custom');
            $table->string('message')->nullable();
            $table->string('user_avatar')->nullable();
            $table->string('user_handle')->nullable();
            $table->string('user_formal_name')->nullable();
            $table->boolean('published')->nullable();
            $table->datetime('datetime')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }
}