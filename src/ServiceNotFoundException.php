<?php
declare(strict_types=1);

namespace Konecnyjakub\Container;

use Psr\Container\NotFoundExceptionInterface;
use RuntimeException;

/**
 * Exception thrown when requesting a non-existing service from a container
 */
class ServiceNotFoundException extends RuntimeException implements NotFoundExceptionInterface
{
}
