<?php

namespace OctoFlare\Embedder\Providers;

class Coub extends ProviderAbstract
{
    /**
     * {@inheritdoc}
     */
    public function validateUrl()
    {
        $this->url->stripQueryString();
        $this->url->stripLastSlash();
        $this->url->stripWWW();

        return (preg_match('~coub\.com/(?:view|embed)/(?:[\w\d]+)$~i', $this->url));
    }

    /**
     * {@inheritdoc}
     */
    protected function normalizeUrl()
    {
        $this->url->stripQueryString();
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl()
    {
        preg_match('~/([\w\d]+)$~i', $this->url, $matches);

        return "//coub.com/embed/{$matches['1']}?muted=false&autostart=false&originalSize=false&hideTopBar=false&startWithHD=false";
    }
}