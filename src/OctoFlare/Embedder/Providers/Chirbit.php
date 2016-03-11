<?php

namespace OctoFlare\Embedder\Providers;

use OctoFlare\Embedder\Url;

class Chirbit extends ProviderAbstract
{
    /**
     * {@inheritdoc}
     */
    public function validateUrl()
    {
        return (preg_match('~chirb\.it/(?:[\w\d]+)/?$~i', $this->url));
    }

    /**
     * {@inheritdoc}
     */
    protected function normalizeUrl()
    {
        if (preg_match('~chirb\.it/wp/([\w\d]+)/?~i', $this->url, $matches)) {
            $this->url = new Url('http://chirb.it/' . $matches['1']);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl()
    {
        preg_match('~chirb\.it/([\w\d]+)/?~i', $this->url, $matches);

        return "//chirb.it/wp/{$matches['1']}";
    }

}
