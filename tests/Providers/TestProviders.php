<?php

namespace OctoFlare\Embedder\Test\Providers;

use Exception;
use InvalidArgumentException;
use PHPUnit_Framework_TestCase;

class TestProviders extends PHPUnit_Framework_TestCase
{
    /** @var array */
    protected $urls;

    /**
     * This method is used to validate the behaviour of a Service Provider.
     *
     * @large
     */
    protected function validateProvider($s)
    {
        if (empty($this->urls)) {
            throw new Exception('No urls specified for the service ' . $s);
        }

        $this->validateDetection($s, $this->urls['valid'], $this->urls['invalid']);

        if (!empty($this->urls['normalize'])) {
            $this->validateUrlNormalization($s, $this->urls['normalize']);
        }

        $this->validateWrongUrlResponse($s, $this->urls['invalid']);
    }

    /**
     * Checks if all valid urls are correctly detected
     * @medium
     */
    protected function validateDetection($s, array $validUrls, array $invalidUrls)
    {
        $p = new \OctoFlare\Embedder\Providers();
        $this->assertCount(count($validUrls), $p->all($validUrls),
            $s . ' The valid Urls do not seem to be detected correctly');

        $p = new \OctoFlare\Embedder\Providers();
        $this->assertCount(count($validUrls), $p->all(array_merge($validUrls, $invalidUrls)),
            $s . ' There is at least one invalid url recognized as valid');

        $p = new \OctoFlare\Embedder\Providers();
        $this->assertCount(1, $p->all($validUrls[mt_rand(0, (count($validUrls) - 1))]),
            $s . ' One Correct url seems to be invalid');
    }

    /**
     * Validates that a url on this service is correctly normalized
     * @medium
     */
    protected function validateUrlNormalization($service, array $normalizeUrls)
    {
        $service = "\\OctoFlare\\Embedder\\Providers\\{$service}";

        foreach ($normalizeUrls as $given => $expected) {
            $test = new $service($given);
            $this->assertEquals($expected, $test->getUrl());
        }
    }

    /**
     * Validates a response from an invalid url for the current service
     * @large
     */
    protected function validateWrongUrlResponse($service, array $urls)
    {
        $service = "\\OctoFlare\\Embedder\\Providers\\{$service}";
        foreach ($urls as $url) {
            $test = new $service($url);
            $this->assertEquals($test->validateUrl(), false);
        }
    }
}