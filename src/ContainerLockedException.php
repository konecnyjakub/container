<?php
declare(strict_types=1);

namespace Konecnyjakub\Container;

use Psr\Container\ContainerExceptionInterface;
use RuntimeException;

class ContainerLockedException extends RuntimeException implements ContainerExceptionInterface
{
}
