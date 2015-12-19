<?php

namespace OctoFlare\Embedder\Test\Providers;

class YoutubeTest extends TestProviders
{
    protected $urls = [
        'valid' => [
            'https://www.youtube.com/watch?v=9bZkp7q19f0',
            'http://youtube.com/watch?v=J---aiyznGQ',
            'https://www.youtube.com/watch?v=xVrJ8DxECbg&list=PLwnD0jwK0yymXOCl82nqdTdxe0ykVDcPW&index=1',
            'http://youtube.com/watch?v=xVrJ8DxECbg&list=PLwnD0jwK0yymXOCl82nqdTdxe0ykVDcPW',
            'http://www.youtube.com/watch?v=WtPiGYsllos&index=1',
            'https://m.youtube.com/watch?v=mghhLqu31cQ',
            'https://m.youtube.com/watch?v=wB3sjAIARIY',
            'http://youtube.com/embed/mghhLqu31cQ',
            'http://www.youtube.com/embed/mghhLqu31cQ',
            'http://youtu.be/8aGEb_yUpMs'
        ],
        'invalid' => [
            'http://youtube.com/watch?list=hi',
            'http://youtube.com /watch?video=J---aiyznGQ',
            'http://www.youtu.be.com/watch?lol=no',
            'http://www.youtube.com/hi#ho',
            'http://youtube.com/',
            'http://www.youtube.com/?id=ho'
        ],
        'normalize' => [
            'http://youtu.be/9bZkp7q19f0/werwer' => '//www.youtube.com/embed/9bZkp7q19f0',
            'http://www.youtube.com/watch?v=9bZkp7q19f0' => '//www.youtube.com/embed/9bZkp7q19f0',
            'http://youtube.com/watch?v=xVrJ8DxECbg&list=PLwnD0jwK0yymXOCl82nqdTdxe0ykVDcPW&index=1' => '//www.youtube.com/embed/xVrJ8DxECbg',
            'http://youtu.be/8aGEb_yUpMs' => '//www.youtube.com/embed/8aGEb_yUpMs',
            'http://youtube.com/watch?v=J---aiyznGQ&index=1' => '//www.youtube.com/embed/J---aiyznGQ',
            'http://youtube.com/watch?v=mghhLqu31cQ' => '//www.youtube.com/embed/mghhLqu31cQ',
            'http://youtube.com/embed/mghhLqu31cQ' => '//www.youtube.com/embed/mghhLqu31cQ',
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
        $this->validateProvider('Youtube');
    }
}
