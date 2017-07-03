<?php

use PHPUnit\Framework\TestCase;

class TwitterTest extends TestCase
{

    public $runTestInSeparateProcesswitter;

    public function __construct($name = null, array $data = [], $dataName = null)
    {
        $this->twitter = new \Scopefragger\LaravelSocialy\Services\TwitterService();
        $this->twitter->user = 'markajon3s';
        $this->twitter->fetch = 10;
        $this->twitter->rebuildUrl();
        parent::__construct($name, $data, $dataName);
    }

    public function testAuthorise()
    {
        $this->twitter->authorise();
    }
}