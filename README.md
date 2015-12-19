# Super Simple Video Embedder

[![Latest Stable Version](https://poser.pugx.org/torann/embedder/v/stable.png)](https://packagist.org/packages/torann/embedder) [![Total Downloads](https://poser.pugx.org/torann/embedder/downloads.png)](https://packagist.org/packages/torann/embedder) [![Build Status](https://travis-ci.org/Torann/embedder.svg?branch=master)](https://travis-ci.org/Torann/embedder)

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
$embedder = new \Torann\Embedder\Embed();

$output = $embedder->getUrl($text);
```

Will output string:

```
//www.youtube.com/embed/W9cA9Z4bNzk
```

### Extracting All Videos

```php
$text = 'Hi, I just saw this video https://www.youtube.com/watch?v=W9cA9Z4bNzk and the http://youtu.be/dMH0bHeiddddd';
$embedder = new \Torann\Embedder\Embed();

$output = $embedder->getUrls($text);
```

Will output array:

```
[
    'https://www.youtube.com/watch?v=W9cA9Z4bNzk' => '//www.youtube.com/embed/W9cA9Z4bNzk',
    'http://youtu.be/dMH0bHeiddddd' => '//www.youtube.com/embed/dMH0bHeiddddd'
]
```

## Change Log

**12/19/2015**

 - First release