<?php

namespace OctoFlare\Embedder\Test\Providers;

class CoubTest extends TestProviders
{
    protected $urls = [
        'valid' => [
            'http://coub.com/view/2gik7tu6',
            'http://coub.com/view/1i2na5tm',
            'http://www.coub.com/view/2oa3zbsr',
            'http://coub.com/embed/20v82p5j',
            'http://coub.com/embed/omwe0oe/',
            'http://coub.com/view/2m7mett8/',
            'http://coub.com/embed/29zkqoco',
        ],
        'invalid' => [
            'http://coub.com/explore/art-design',
            'http://coub.com/view/2m7mett8/other-stuff/',
            'http://coub.com/explore/girls',
            'http://coub.com/embed/',
            'http://coub.com/view/',
            'http://coub.com/',
        ],
        'normalize' => [
            'http://coub.com/view/231nevc?small_suggest_place=3' => '//coub.com/embed/231nevc?muted=false&autostart=false&originalSize=false&hideTopBar=false&startWithHD=false',
            'http://coub.com/view/231nevc/?small_suggest_place=3&stuff=hihi-hi' => '//coub.com/embed/231nevc?muted=false&autostart=false&originalSize=false&hideTopBar=false&startWithHD=false',
            'http://www.coub.com/view/231nevc?small_suggest_place=3&stuff=hihi-hi' => '//coub.com/embed/231nevc?muted=false&autostart=false&originalSize=false&hideTopBar=false&startWithHD=false',
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
        $this->validateProvider('Coub');
    }
}
