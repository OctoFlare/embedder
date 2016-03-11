<?php

namespace OctoFlare\Embedder\Providers;

use OctoFlare\Embedder\Url;

class Youtube extends ProviderAbstract
{
    /**
     * {@inheritdoc}
     */
    public function validateUrl()
    {
        return (preg_match('~v=(?:[a-z0-9_-]+)~i', $this->url));
    }

    /**
     * {@inheritdoc}
     */
    protected function normalizeUrl()
    {
        if (preg_match('~(?:v=|youtu\.be/|youtube\.com/embed/)([a-z0-9_-]+)~i', $this->url, $matches)) {
            $this->url = new Url('http://www.youtube.com/watch?v=' . $matches[1]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl()
    {
        preg_match('~v=([a-z0-9_-]+)~i', $this->url, $matches);

        return "//www.youtube.com/embed/{$matches['1']}";
    }
}
