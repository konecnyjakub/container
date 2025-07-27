<?php
declare(strict_types=1);

namespace Konecnyjakub\Container;

use Psr\Container\ContainerExceptionInterface;
use RuntimeException;

/**
 * Exception thrown when trying to modify a locked container (adding/changing/deleting a service)
 */
class ContainerLockedException extends RuntimeException implements ContainerExceptionInterface
{
}
