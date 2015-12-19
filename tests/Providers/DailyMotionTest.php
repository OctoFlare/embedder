<?php

namespace OctoFlare\Embedder\Test\Providers;

class DailyMotionTest extends TestProviders
{
    protected $urls = [
        'valid' => [
            'http://www.dailymotion.com/video/xxwxe1_harlem-shake-de-los-simpsons_fun',
            'http://dailymotion.com/video/xp30q9_bmw-serie3-2012-en-mexico_auto',
            'http://www.dailymotion.com/video/xzva95_jacob-jones-and-the-bigfoot-mystery-launch-trailer_videogames',
            'http://www.dailymotion.com/video/xzx4m4_balotelli-au-prochain-cri-raciste-je-quitte-le-terrain_sport?from=rss',
            'http://www.dailymotion.com/video/xzse1m_casanova-tout-reste-possible-pour-l-om_sport/stuff/here/',
            'http://www.dailymotion.com/embed/video/xzv0cd/',
            'http://dai.ly/xzse1m',
            'http://games.dailymotion.com/video/xq3p3u',
            'http://games.dailymotion.com/video/x2gfjhs',
            'http://games.dailymotion.com/live/x15gjhi',
        ],
        'invalid' => [
            'http://www.dailymotion.com',
            'http://dailymotion.com',
            'http://www.dailymotion.com/channel/stuff/',
            'http://www.dailymotion.com/stuff/',
            'http://www.dailymotion.com/video/'
        ],
        'normalize' => [
            'http://www.dailymotion.com/video/xxwxe1_harlem-shake-de-los-simpsons_fun' => '//www.dailymotion.com/embed/video/xxwxe1',
            'http://dailymotion.com/video/xp30q9_bmw-serie3-2012-en-mexico_auto' => '//www.dailymotion.com/embed/video/xp30q9',
            'http://www.dailymotion.com/video/xzxtaf_red-bull-400-alic-y-stadlober-ganan-en-eslovenia_sport/' => '//www.dailymotion.com/embed/video/xzxtaf',
            'http://www.dailymotion.com/embed/video/xzxfpu' => '//www.dailymotion.com/embed/video/xzxfpu',
            'http://www.dailymotion.com/video/xzx4m4_balotelli-au-prochain-cri-raciste-je-quitte-le-terrain_sport?from=rss' => '//www.dailymotion.com/embed/video/xzx4m4',
            'http://www.dailymotion.com/embed/video/xzv0cd/' => '//www.dailymotion.com/embed/video/xzv0cd',
            'http://www.dailymotion.com/video/xzse1m_casanova-tout-reste-possible-pour-l-om_sport/stuff/here/' => '//www.dailymotion.com/embed/video/xzse1m',
            'http://dai.ly/xzv0cd/' => '//www.dailymotion.com/embed/video/xzv0cd',
            'http://dai.ly/xzv0cd' => '//www.dailymotion.com/embed/video/xzv0cd',
            'http://games.dailymotion.com/live/xq3p3u' => '//www.dailymotion.com/embed/video/xq3p3u',
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
        $this->validateProvider('DailyMotion');
    }
}
