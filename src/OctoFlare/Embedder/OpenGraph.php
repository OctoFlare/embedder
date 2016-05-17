<?php

namespace OctoFlare\Embedder;

use DOMDocument;

class OpenGraph
{
    /**
     * Fetches a URI and parses it for meta data.
     *
     * @param string $url
     *
     * @return array|null
     */
    public function fetch($url)
    {
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_FAILONERROR, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 15); // Timeout in seconds
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_USERAGENT, "facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)");

        $response = mb_convert_encoding(curl_exec($curl), 'HTML-ENTITIES', 'UTF-8');

        curl_close($curl);

        if (empty($response)) {
            return null;
        }

        return $this->parse($response);
    }

    /**
     * Parses HTML and extracts meta data, this assumes
     * the document is at least well formed.
     *
     * @param string $html
     *
     * @return array|null
     */
    private function parse($html)
    {
        $attributes = [];

        $old_libxml_error = libxml_use_internal_errors(true);

        // Create DOM document
        $doc = new DOMDocument();
        $doc->loadHTML($html);

        libxml_use_internal_errors($old_libxml_error);

        // Get meta tags from HTML
        $tags = $doc->getElementsByTagName('meta');

        if (!$tags || $tags->length === 0) {
            return null;
        }

        // Process tags
        foreach ($tags AS $tag) {
            // OpenGraph specific attributes
            if ($tag->hasAttribute('property') && strpos($tag->getAttribute('property'), 'og:') === 0) {
                $key = strtr(substr($tag->getAttribute('property'), 3), '-', '_');
                $attributes[$key] = $tag->getAttribute('content');

                // Override content value with the value attribute.
                if ($tag->hasAttribute('value')) {
                    $attributes[$key] = $tag->getAttribute('value');
                }
            }

            // OctoFlare specific attributes
            if ($tag->hasAttribute('property') && strpos($tag->getAttribute('property'), 'oct:') === 0) {
                $key = strtr(substr($tag->getAttribute('property'), 4), '-', '_');
                $attributes[$key] = $tag->getAttribute('content');
            }

            // Set description
            if ($tag->hasAttribute('name') && $tag->getAttribute('name') === 'description') {
                if (!isset($attributes['description'])) {
                    $attributes['description'] = $tag->getAttribute('content');
                }
            }
        }

        // Set title
        if (!isset($attributes['title'])) {
            $titles = $doc->getElementsByTagName('title');

            if ($titles->length > 0) {
                $attributes['title'] = $titles->item(0)->textContent;
            }
        }

        return $attributes;
    }
}