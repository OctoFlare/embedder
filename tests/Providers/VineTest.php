<?php

namespace OctoFlare\Embedder\Test\Providers;

class VineTest extends TestProviders
{
    protected $urls = [
        'valid' => [
            'https://vine.co/v/OZQ61X9KWwB',
            'https://vine.co/v/OzPtPEPOwVI/',
            'http://vine.co/v/MEDKjeFnx2B',
            'http://vine.co/v/MUq1itKiPhQ/',
        ],
        'invalid' => [
            'https://vine.co/editors-picks',
            'http://vine.co/v/MUq1itKiPhQ/other-stuff',
            'https://vine.co/search/asdas',
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
        $this->validateProvider('Vine');
    }
}
