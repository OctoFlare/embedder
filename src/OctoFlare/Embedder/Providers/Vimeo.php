<?php

namespace OctoFlare\Embedder\Providers;

use OctoFlare\Embedder\Url;

class Vimeo extends ProviderAbstract
{
    /** {@inheritdoc} */
    public function validateUrl()
    {
        $this->url->stripWWW();
        $this->url->stripLastSlash();

        return (preg_match('~/(?:[0-9]{5,12})$~i', $this->url));
    }

    /** {@inheritdoc} */
    protected function normalizeUrl()
    {
        $this->url->stripQueryString();

        if (preg_match('~/([0-9]{5,12})/?$~i', $this->url, $matches)) {
            $this->url = new Url('http://vimeo.com/' . $matches['1']);
        }
    }

    /** {@inheritdoc} */
    public function getUrl()
    {
        preg_match('~/([0-9]{5,12})$~i', $this->url, $matches);

        return "//player.vimeo.com/video/{$matches['1']}?badge=0";
    }
}

