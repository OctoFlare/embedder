<?php

namespace OctoFlare\Embedder\Test;

use Mockery;
use PHPUnit_Framework_TestCase;

class EmbedTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testGetUrl()
    {
        $input = 'Hi, I just saw this video https://www.youtube.com/watch?v=W9cA9Z4bNzk and the http://youtu.be/dMH0bHeid';
        $embedder = new \OctoFlare\Embedder\Embed();

        $this->assertEquals('//www.youtube.com/embed/W9cA9Z4bNzk', $embedder->getUrl($input));
    }

    /**
     * @test
     */
    public function testGetUrls()
    {
        $input = 'Hi, I just saw this video https://www.youtube.com/watch?v=W9cA9Z4bNzk and the http://youtu.be/dMH0bHeid';
        $embedder = new \OctoFlare\Embedder\Embed();

        $this->assertEquals([
            'https://www.youtube.com/watch?v=W9cA9Z4bNzk' => '//www.youtube.com/embed/W9cA9Z4bNzk',
            'http://youtu.be/dMH0bHeid' => '//www.youtube.com/embed/dMH0bHeid',
        ], $embedder->getUrls($input));
    }
}
