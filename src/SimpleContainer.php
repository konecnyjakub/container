<?php
declare(strict_types=1);

namespace Konecnyjakub\Container;

use Psr\Container\ContainerInterface;

final class SimpleContainer implements ContainerInterface
{
    /** @var array<string, mixed> */
    private array $services = [];

    private bool $locked = false;

    public function get(string $id): mixed
    {
        if (!$this->has($id)) {
            throw new ServiceNotFoundException("The container does not have service $id");
        }
        return $this->services[$id];
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->services);
    }

    public function set(string $id, mixed $service): void
    {
        if ($this->locked) {
            throw new ContainerLockedException("A service cannot be added to/changed in a locked container");
        }
        $this->services[$id] = $service;
    }

    public function delete(string $id): void
    {
        if ($this->locked) {
            throw new ContainerLockedException("A service cannot be deleted from a locked container");
        }
        unset($this->services[$id]);
    }

    public function isLocked(): bool
    {
        return $this->locked;
    }

    public function lock(): void
    {
        $this->locked = true;
    }
}
