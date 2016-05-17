# Super Simple Link Embedder

[![Latest Stable Version](https://poser.pugx.org/octoflare/embedder/v/stable.png)](https://packagist.org/packages/octoflare/embedder) [![Total Downloads](https://poser.pugx.org/octoflare/embedder/downloads.png)](https://packagist.org/packages/octoflare/embedder) [![Build Status](https://travis-ci.org/OctoFlare/embedder.svg)](https://travis-ci.org/OctoFlare/embedder)

Fetch embeddable links from text.

## Installation

### Composer

From the command line run:

```
$ composer require octoflare/embedder
```

## Examples

### Extracting First Valid Video

```php
$text = 'Hi, I just saw this video https://www.youtube.com/watch?v=W9cA9Z4bNzk and the http://youtu.be/dMH0bHeiddddd';
$embedder = new \OctoFlare\Embedder\Embed();

$output = $embedder->getUrl($text);
```

Will output string:

```
//www.youtube.com/embed/W9cA9Z4bNzk
```

### Extracting All Videos

```php
$text = 'Hi, I just saw this video https://www.youtube.com/watch?v=W9cA9Z4bNzk and the http://youtu.be/dMH0bHeiddddd';
$embedder = new \OctoFlare\Embedder\Embed();

$output = $embedder->getUrls($text);
```

Will output array:

```
[
    'https://www.youtube.com/watch?v=W9cA9Z4bNzk' => '//www.youtube.com/embed/W9cA9Z4bNzk',
    'http://youtu.be/dMH0bHeiddddd' => '//www.youtube.com/embed/dMH0bHeiddddd'
]
```

## OpenGraph

Access OpenGraph meta data of a given URL.

```php
$embedder = new \OctoFlare\Embedder\Embed();

$output = $embedder->getMeta('http://www.rottentomatoes.com/m/771439257');
```

Will output array:

```
[
  "description" => "In this heart-pounding thriller from acclaimed writer and director Mike Flanagan (Oculus, Before I Wake), silence takes on a terrifying new dimension for a..."
  "title" => "Hush"
  "type" => "video.movie"
  "image" => "https://resizing.flixster.com/R6FvucOnw5bYh_sffSMbvFSXX2w=/220x326/v1.bTsxMTcwNDk2MDtqOzE2OTc1OzIwNDg7MjIwOzMyNg"
  "image:width" => "800"
  "image:height" => "1200"
  "url" => "http://www.rottentomatoes.com/m/771439257/"
]
```

## Change Log

**05/17/2016**

 - Add simple OpenGraph support

**12/19/2015**

 - First release