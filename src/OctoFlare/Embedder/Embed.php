<?php

namespace OctoFlare\Embedder;

class Embed
{
    /**
     * Providers instance.
     *
     * @var \OctoFlare\Embedder\Providers
     */
    protected $providers;

    /**
     * OpenGraph instance.
     *
     * @var \OctoFlare\Embedder\OpenGraph
     */
    protected $opengraph;

    /**
     * The pattern used to extract urls from a text
     *
     * @var string
     */
    protected $urlRegex = '~\bhttps?:\/\/[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]?|\/|_))~i';

    /**
     * Constructs new embed instance.
     */
    public function __construct()
    {
        $this->providers = new Providers();
        $this->opengraph = new OpenGraph();
    }

    /**
     * Get embeddable version of URL.
     *
     * @param string $body
     *
     * @return string
     */
    public function getUrl($body = null)
    {
        if (preg_match_all($this->urlRegex, $body, $matches)) {
            $service = $this->providers->first($matches['0']);

            return $service->getUrl();
        }

        return '';
    }

    /**
     * Get the OpenGraph data for the URL.
     *
     * @param string $url
     *
     * @return array|null
     */
    public function getMeta($url)
    {
        return $this->opengraph->fetch($url);
    }

    /**
     * Get embeddable version of a set of URLs.
     *
     * @param string|array $body
     *
     * @return array
     */
    public function getUrls($body = null)
    {
        $providers = $results = [];

        if (is_array($body)) {
            $body = array_filter($body, function ($arr) {
                return preg_match($this->urlRegex, $arr);
            });

            $providers = $this->providers->all($body);
        }
        elseif (preg_match_all($this->urlRegex, $body, $matches)) {
            $providers = $this->providers->all($matches['0']);
        }

        foreach ($providers as $url => $service) {
            $results[$url] = $service->getUrl();
        }

        return array_filter($results);
    }
}