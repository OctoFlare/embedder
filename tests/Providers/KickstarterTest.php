<?php

namespace OctoFlare\Embedder\Test\Providers;

class KickstarterTest extends TestProviders
{
    protected $urls = [
        'valid' => [
            'http://www.kickstarter.com/projects/1330686256/americas-candy-all-natural-vegan-and-allergy-frien?ref=home_popular',
            'http://www.kickstarter.com/projects/yonder/dino-pet-a-living-bioluminescent-night-light-pet?ref=home_popular',
            'http://www.kickstarter.com/projects/762504755/apparitions-from-the-inferno?ref=home_location',
            'http://kickstarter.com/projects/1093644807/and-the-meek-shall-inherit',
            'http://www.kickstarter.com/projects/940737263/a-very-special-new-stripped-down-sea-wolf-album',
            'http://www.kickstarter.com/projects/DaveRyan/owlgirls',
            'http://www.kickstarter.com/projects/lenswithaview/standing-in-the-stars-the-peter-mayhew-story',
        ],
        'invalid' => [
            'http://www.kickstarter.com/discover',
            'http://www.kickstarter.com/start',
            'http://www.kickstarter.com/',
            'http://www.kickstarter.com/DaveRyan/owlgirls',
            'http://www.kickstarter.com/projects/DaveRyan',
        ],
        'normalize' => [
            'http://www.kickstarter.com/projects/1330686256/americas-candy-all-natural-vegan-and-allergy-frien?ref=home_popular' => 'http://www.kickstarter.com/projects/1330686256/americas-candy-all-natural-vegan-and-allergy-frien/widget/video.html',
            'http://www.kickstarter.com/projects/1330686256/americas-candy-all-natural-vegan-and-allergy-frien?ref=home_popular&other=stuff-yeah' => 'http://www.kickstarter.com/projects/1330686256/americas-candy-all-natural-vegan-and-allergy-frien/widget/video.html',
            'http://www.kickstarter.com/projects/1330686256/americas-candy-all-natural-vegan-and-allergy-frien' => 'http://www.kickstarter.com/projects/1330686256/americas-candy-all-natural-vegan-and-allergy-frien/widget/video.html',
            'http://kickstarter.com/projects/1330686256/americas-candy-all-natural-vegan-and-allergy-frien' => 'http://www.kickstarter.com/projects/1330686256/americas-candy-all-natural-vegan-and-allergy-frien/widget/video.html',
            'https://kickstarter.com/projects/1330686256/americas-candy-all-natural-vegan-and-allergy-frien' => 'https://www.kickstarter.com/projects/1330686256/americas-candy-all-natural-vegan-and-allergy-frien/widget/video.html',
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
        $this->validateProvider('Kickstarter');
    }
}
