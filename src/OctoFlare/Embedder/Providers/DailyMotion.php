<?php

namespace OctoFlare\Embedder\Providers;

use OctoFlare\Embedder\Url;

class DailyMotion extends ProviderAbstract
{
    /** {@inheritdoc} */
    public function validateUrl()
    {
        $this->url->addWWW();
        $this->url->stripQueryString();
        $this->url->stripLastSlash();

        return (preg_match('~dailymotion\.com/video/(?:[^/]+)/?~i', $this->url));
    }

    /** {@inheritdoc} */
    protected function normalizeUrl()
    {
        if (preg_match('~dailymotion\.com/(?:embed/)?(?:video|live)/([^/]+)/?~i', $this->url, $matches)) {
            $this->url = new Url('http://www.dailymotion.com/video/' . $matches['1']);
        }
        else {
            if (preg_match('~dai\.ly/([^/]+)/?~i', $this->url, $matches)) {
                $this->url = new Url('http://www.dailymotion.com/video/' . $matches['1']);
            }
        }
    }

    /** {@inheritdoc} */
    public function getUrl()
    {
        preg_match('~/video/([^/]+)~i', $this->url, $matches);

        @list($videoId, $videoTitle) = explode('_', $matches['1'], 2);

        return "//www.dailymotion.com/embed/video/{$videoId}";
    }
}
