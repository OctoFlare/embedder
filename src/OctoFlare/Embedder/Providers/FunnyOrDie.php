<?php

namespace OctoFlare\Embedder\Providers;

use OctoFlare\Embedder\Url;

class FunnyOrDie extends ProviderAbstract
{
    /**
     * {@inheritdoc}
     */
    public function validateUrl()
    {
        $this->url->stripQueryString();
        $this->url->stripLastSlash();

        return (preg_match('~funnyordie\.com/videos/(?:[\w\d]+)~i', $this->url));
    }

    /**
     * {@inheritdoc}
     */
    protected function normalizeUrl()
    {
        if (preg_match('~\.com/embed/~i', $this->url)) {
            $this->url = new Url(str_ireplace('/embed/', '/videos/', $this->url));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl()
    {
        preg_match('~/videos/([\w\d]+)/?~', $this->url, $matches);

        return "//www.funnyordie.com/embed/{$matches['1']}";
    }
}
