<?php

namespace OctoFlare\Embedder\Providers;

class Vine extends ProviderAbstract
{
    /**
     * {@inheritdoc}
     */
    public function validateUrl()
    {
        $this->url->stripQueryString();
        $this->url->stripLastSlash();
        $this->url->convertToHttps();

        return (preg_match('~vine\.co/v/(?:[^/]+)$~i', $this->url));
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl()
    {
        return "{$this->url}/embed/simple";
    }
}
