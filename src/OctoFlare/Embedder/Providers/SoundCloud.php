<?php

namespace OctoFlare\Embedder\Providers;

class SoundCloud extends ProviderAbstract
{
    /**
     * {@inheritdoc}
     */
    public function validateUrl()
    {
        $this->url->stripLastSlash();

        $this->url->invalidPattern('soundcloud\.com/(explore|creators|groups)/?$');

        return (preg_match('~soundcloud\.com/(?:[\w\d\-_]+)~i', $this->url));
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl()
    {
        return "https://w.soundcloud.com/player/?url={$this->url}&visual=true&liking=false&sharing=false&auto_play=false&show_comments=false&continuous_play=false";
    }
}
