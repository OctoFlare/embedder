<?php

namespace OctoFlare\Embedder\Test\Providers;

class ChirbitTest extends TestProviders
{
    protected $urls = [
        'valid' => [
            'http://chirb.it/w3gGKr',
            'http://chirb.it/gJDBHO',
            'http://chirb.it/wtJs5e/',
            'http://www.chirb.it/185err',
            'http://chirb.it/x0sw0k',
            'http://chirb.it/zGt9tG',
        ],
        'invalid' => [
            'http://chirbit.it/top-50-chirbits-this-week.php',
            'http://www.chirbit.com/top-50-chirbits-this-week.php',
            'http://www.chirbit.com/',
            'http://chirb.it',
        ],
        'normalize' => [
            'http://chirb.it/wtJs5e/' => '//chirb.it/wp/wtJs5e',
            'http://chirb.it/wtJs5e/other/stuff' => '//chirb.it/wp/wtJs5e',
            'http://chirb.it/wtJs5e' => '//chirb.it/wp/wtJs5e',
        ],
        'fake' => [
            'type' => 'rich',
            'html' => '<iframe'
        ]
    ];

    /**
     * @test
     */
    public function testProvider()
    {
        $this->validateProvider('Chirbit');
    }
}
