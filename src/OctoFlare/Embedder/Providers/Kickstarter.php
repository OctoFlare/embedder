<?php

namespace OctoFlare\Embedder\Providers;

class Kickstarter extends ProviderAbstract
{
    /**
     * {@inheritdoc}
     */
    public function validateUrl()
    {
        $this->url->stripQueryString();
        $this->url->stripLastSlash();
        $this->url->addWWW();

        return (preg_match('~/projects/(?:[^/]+)/(?:[^/]+)$~i', $this->url));
    }

    /**
     * {@inheritdoc}
     */
    protected function normalizeUrl()
    {
        $this->url->addWWW();
        $this->url->stripQueryString();
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl()
    {
        return "{$this->url}/widget/video.html";
    }
}
