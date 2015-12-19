<?php

namespace OctoFlare\Embedder;

class Providers
{
    /**
     * Configuration Settings
     *
     * @var array
     */
    protected $config = [];

    /**
     * Hosts with wildcards, calculated at runtime
     *
     * @var array
     */
    protected $wildCardHosts = [];

    /**
     * Mapping of host to provider class relation
     *
     * @var array
     */
    protected $services = [
        'chirb.it' => Providers\Chirbit::class,
//        'collegehumor.com' => Providers\CollegeHumor::class,  // Can stop auto-play
        'coub.com' => Providers\Coub::class,
        '*.dailymotion.com' => Providers\DailyMotion::class,
        'dai.ly' => Providers\DailyMotion::class,
        'funnyordie.com' => Providers\FunnyOrDie::class,
        'kickstarter.com' => Providers\Kickstarter::class,
        'vimeo.com' => Providers\Vimeo::class,
        'vine.co' => Providers\Vine::class,
        'm.youtube.com' => Providers\Youtube::class,
        'youtube.com' => Providers\Youtube::class,
        'youtu.be' => Providers\Youtube::class,
    ];

    /**
     * Create new providers instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Returns first valid services found.
     *
     * @param  array|string $urls
     * @return mixed
     */
    public function first($urls)
    {
        $this->wildCardHosts = array_filter(array_keys($this->services), function ($key) {
            return (strpos($key, '*') !== false);
        });

        return $this->find((array) $urls, true);
    }

    /**
     * Returns an array with all valid services found.
     *
     * @param  array|string $urls
     * @return array
     */
    public function all($urls)
    {
        $this->wildCardHosts = array_filter(array_keys($this->services), function ($key) {
            return (strpos($key, '*') !== false);
        });

        return $this->find((array) $urls);
    }

    /**
     * Finds services for the given $urls.
     *
     * @param  array $urls
     * @param  bool  $firstOnly
     * @return mixed
     */
    protected function find(array $urls = [], $firstOnly = false)
    {
        $return = [];

        foreach (array_unique($urls) as $url) {
            $host = $this->getHost($url);

            if ($host && isset($this->services[$host])) {
                $service = new $this->services[$host]($url);

                if ($service->validateUrl()) {
                    if ($firstOnly === true) {
                        return $service;
                    }

                    $return[$url] = $service;
                }
            }
        }

        return $return;
    }

    /**
     * Gets a normalized host for the given $url
     *
     * @param  string $url
     * @return string
     */
    protected function getHost($url)
    {
        $data = parse_url($url);

        if (empty($data['host'])) {
            return null;
        }

        $host = preg_replace('~^(?:www|player)\.~i', '', strtolower($data['host']));

        if (isset($this->services[$host])) {
            return $host;
        }
        else {
            if (isset($this->services['*.' . $host])) {
                return '*.' . $host;
            }
            elseif (!empty($this->wildCardHosts)) {
                $trans = ['\*' => '(?:.*)'];

                foreach ($this->wildCardHosts as $value) {
                    $regex = strtr(preg_quote($value, '~'), $trans);

                    if (preg_match('~' . $regex . '~i', $host)) {
                        return $value;
                    }
                }
            }
        }

        return $host;
    }
}

