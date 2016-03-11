<?php

namespace OctoFlare\Embedder\Providers;

class CollegeHumor extends ProviderAbstract
{
    /**
     * {@inheritdoc}
     */
    public function validateUrl()
    {
        $this->url->addWWW();

        return (preg_match('~collegehumor\.com/(?:video|embed)/(?:[0-9]{5,10})/?~i', $this->url));
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
        $this->url->removeHttp();

        return str_replace(['/video/', '/embed/'], '/e/', $this->url) . '?autoplay=off';
    }
}