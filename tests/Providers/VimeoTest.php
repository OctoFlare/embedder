<?php

namespace OctoFlare\Embedder\Test\Providers;

class VimeoTest extends TestProviders
{
    protected $urls = [
        'valid' => [
            'http://vimeo.com/channels/staffpicks/66252440',
            'http://vimeo.com/channels/staffpicks/65535198/',
            'http://vimeo.com/groups/shortfilms/videos/66185763',
            'https://vimeo.com/groups/shortfilms/videos/63313811/',
            'http://vimeo.com/47360546',
            'http://vimeo.com/39892335/',
            'https://player.vimeo.com/video/65297606',
            'https://player.vimeo.com/video/25818086/'
        ],
        'invalid' => [
            'http://vimeo.com/groups/shortfilms/videos/66185763/stuff/here',
            'http://vimeo.com/47360546/other/stuff/',
            'http://vimeo.com/groups/shortfilms/123',
            'http://vimeo.com/groups/shortfilms',
            'http://vimeo.com/',
            'http://vimeo.com/groups/stuff/?autoplay=1'
        ],
        'normalize' => [
            'http://vimeo.com/channels/staffpicks/66252440' => '//player.vimeo.com/video/66252440?badge=0',
            'http://vimeo.com/channels/staffpicks/65535198/' => '//player.vimeo.com/video/65535198?badge=0',
            'https://player.vimeo.com/video/65297606' => '//player.vimeo.com/video/65297606?badge=0',
            'http://vimeo.com/groups/shortfilms/videos/63313811/' => '//player.vimeo.com/video/63313811?badge=0',
            'http://vimeo.com/47360546' => '//player.vimeo.com/video/47360546?badge=0',
            'http://vimeo.com/39892335/' => '//player.vimeo.com/video/39892335?badge=0',
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
        $this->validateProvider('Vimeo');
    }
}
