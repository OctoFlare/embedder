<?php

namespace OctoFlare\Embedder\Test\Providers;

class FunnyOrDieTest extends TestProviders
{
    protected $urls = [
        'valid' => [
            'http://www.funnyordie.com/videos/a1738b0a3f/i-hate-california-lake-tahoe',
            'http://funnyordie.com/videos/8b2b588243/tom-brady-s-best-friend',
            'http://www.funnyordie.com/videos/6b0b308f41/coming-soon-from-funny-or-die-with-will-ferrell/',
            'http://funnyordie.com/videos/c4d450418e/magician-vs-wild',
            'http://funnyordie.com/embed/c4d450418e/magician-vs-wild',
            'http://funnyordie.com/embed/c4d450418e',
            'http://www.funnyordie.com/videos/bc5f676260/tony-hale-s-acting-process',
            'http://www.funnyordie.com/videos/bc5f676260/tony-hale-s-acting-process/other/stuff',
        ],
        'invalid' => [
            'http://www.funnyordie.com/#search-menu',
            'http://www.funnyordie.com/pictures/2d8a7b4876/get-the-look-miley-cyrus', // Pictures dont allow oembed
            'http://www.funnyordie.com/drunkhistory',
            'http://www.funnyordie.com/browse/videos/all/all/most_viewed/this_week',
            'http://www.funnyordie.com/support/widget',
            'http://www.funnyordie.com/marion_cotillard',
        ],
        'normalize' => [
            'http://www.funnyordie.com/embed/6b0b308f41/coming-soon-from-funny-or-die-with-will-ferrell/' => '//www.funnyordie.com/embed/6b0b308f41',
            'http://www.funnyordie.com/embed/6b0b308f41/' => '//www.funnyordie.com/embed/6b0b308f41',
            'http://www.funnyordie.com/embed/6b0b308f41/?query=string' => '//www.funnyordie.com/embed/6b0b308f41',
        ],
        'fake' => [
            'type' => 'video',
            'html' => '<iframe'
        ]
    ];

    /**
     * @test
     */
    public function testProvider()
    {
        $this->validateProvider('FunnyOrDie');
    }
}
