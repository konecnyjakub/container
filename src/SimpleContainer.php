<?php
declare(strict_types=1);

namespace Konecnyjakub\Container;

use Psr\Container\ContainerInterface;

final class SimpleContainer implements ContainerInterface
{
    /** @var array<string, mixed> */
    private array $services = [];

    public function get(string $id): mixed
    {
        if (!$this->has($id)) {
            throw new ServiceNotFoundException();
        }
        return $this->services[$id];
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->services);
    }

    public function set(string $id, mixed $service): void
    {
        $this->services[$id] = $service;
    }
}
