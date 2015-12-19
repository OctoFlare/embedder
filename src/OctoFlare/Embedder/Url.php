<?php

namespace OctoFlare\Embedder;

class Url
{
    /**
     * The url
     *
     * @var string
     */
    protected $url;

    /**
     * Placeholder for the original url
     *
     * @var string
     */
    protected $original;

    /**
     * Constructs new Url instance
     *
     * @param string $url A valid url string
     */
    public function __construct($url)
    {
        $this->url = $this->original = preg_replace('~^embed:~i', 'http:', $url);
    }

    /**
     * Searches the url for a pattern $pattern.
     * If the pattern matches, the url is marked as invalid
     * and is emptied.
     *
     * @param string $pattern
     * @return void
     */
    public function invalidPattern($pattern)
    {
        if (preg_match('~' . $pattern . '~i', $this->url)) {
            $this->url = '';
        }
    }

    /**
     * Overwrites the value of $this->url with
     * the given parameter.
     *
     * @param string $url
     * @return void
     */
    public function overwrite($url)
    {
        $this->url = $url;
    }

    /**
     * Discards changes made to a url, and goes back to the original
     * url.
     *
     * @return void
     */
    public function discardChanges()
    {
        $this->url = $this->original;
    }

    /**
     * Strips the query string from the url
     *
     * @return void
     */
    public function stripQueryString()
    {
        $this->url = trim(preg_replace('~(\?|#)(.*)$~i', '', $this->url), '/');
    }

    /**
     * Strips the / at the end of a url
     *
     * @return void
     */
    public function stripLastSlash()
    {
        $this->url = rtrim($this->url, '/');
    }

    /**
     * Strips starting www from the url
     *
     * @return void
     */
    public function stripWWW()
    {
        $this->url = str_ireplace('://www.', '://', $this->url);
    }

    /**
     * Adds www. subdomain to the urls
     *
     * @return void
     */
    public function addWWW()
    {
        if (!preg_match('~^https?://www\.~i', $this->url)) {
            $this->url = str_ireplace('://', '://www.', $this->url);
        }
    }

    /**
     * Replaces https protocol to http
     *
     * @return void
     */
    public function removeHttp()
    {
        $this->url = str_ireplace(['https://', 'http://'], '//', $this->url);
    }

    /**
     * Replaces https protocol to http
     *
     * @return void
     */
    public function convertToHttp()
    {
        $this->url = str_ireplace('https://', 'http://', $this->url);
    }

    /**
     * Replaces http protocol to https
     *
     * @return void
     */
    public function convertToHttps()
    {
        $this->url = str_ireplace('http://', 'https://', $this->url);
    }

    /**
     * Returns the full url when
     * the object is casted into a string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->url;
    }
}
