Container
================

[![Total Downloads](https://poser.pugx.org/konecnyjakub/container/downloads)](https://packagist.org/packages/konecnyjakub/container) [![Latest Stable Version](https://poser.pugx.org/konecnyjakub/container/v/stable)](https://gitlab.com/konecnyjakub/container/-/releases) [![build status](https://gitlab.com/konecnyjakub/container/badges/master/pipeline.svg?ignore_skipped=true)](https://gitlab.com/konecnyjakub/container/-/commits/master) [![coverage report](https://gitlab.com/konecnyjakub/container/badges/master/coverage.svg)](https://gitlab.com/konecnyjakub/container/-/commits/master) [![License](https://poser.pugx.org/konecnyjakub/container/license)](https://gitlab.com/konecnyjakub/container/-/blob/master/LICENSE.md)

This is a simple [PSR-11](https://www.php-fig.org/psr/psr-11/) container.

Installation
------------

The best way to install Container is via Composer. Just add konecnyjakub/container to your dependencies.

Quick start
-----------

```php
<?php
declare(strict_types=1);

use Konecnyjakub\Container\SimpleContainer;
use stdClass;

$container = new SimpleContainer();
$service = new stdClass();
$service->var = "abc";
$container->set("one", $service);
$container->has("one"); // true
var_dump($container->get("one") === $service); // true
```

Advanced usage
--------------

This package provides a simple PSR-11 compliant container. It does not have any exciting features/options and frankly, there is little reason to use it a real application. Below are all the things that it can do.

```php
<?php
declare(strict_types=1);

use Konecnyjakub\Container\SimpleContainer;
use stdClass;

$container = new SimpleContainer();
$container->isLocked(); // false
$container->has("one"); // false
$service = new stdClass();
$service->var = "abc";
$container->set("one", $service);
$container->has("one"); // true
var_dump($container->get("one") === $service); // true
$container->delete("one");
$container->has("one"); // false
$container->lock();
$container->isLocked(); // true
$container->set("one", $service); // throws an exception
$container->delete("one"); // throws an exception
```
