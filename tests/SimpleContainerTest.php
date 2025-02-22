<?php
declare(strict_types=1);

namespace Konecnyjakub\Container;

use MyTester\Attributes\TestSuite;
use MyTester\TestCase;
use stdClass;

#[TestSuite("SimpleContainer")]
final class SimpleContainerTest extends TestCase
{
    public function testProcess(): void
    {
        $service1 = new stdClass();
        $service1->var = "abc";
        $service2 = new stdClass();
        $service2->var = "def";
        $container = new SimpleContainer();

        $this->assertFalse($container->isLocked());
        $this->assertFalse($container->has("one"));
        $this->assertFalse($container->has("two"));
        $this->assertFalse($container->has("test"));
        $this->assertThrowsException(function () use ($container) {
            $container->get("one");
        }, ServiceNotFoundException::class, "The container does not have service one");
        $this->assertThrowsException(function () use ($container) {
            $container->get("two");
        }, ServiceNotFoundException::class, "The container does not have service two");
        $this->assertThrowsException(function () use ($container) {
            $container->get("test");
        }, ServiceNotFoundException::class, "The container does not have service test");
        $this->assertNoException(function () use ($container) {
            $container->delete("one");
            $container->delete("two");
            $container->delete("test");
        });

        $container->set("one", $service1);
        $container->set("two", $service2);
        $this->assertSame($service1, $container->get("one"));
        $this->assertSame($service2, $container->get("two"));
        $this->assertThrowsException(function () use ($container) {
            $container->get("test");
        }, ServiceNotFoundException::class, "The container does not have service test");

        $container->delete("two");
        $container->set("one", $service1);
        $this->assertFalse($container->has("two"));
        $this->assertFalse($container->has("test"));
        $this->assertSame($service1, $container->get("one"));
        $this->assertThrowsException(function () use ($container) {
            $container->get("two");
        }, ServiceNotFoundException::class, "The container does not have service two");
        $this->assertThrowsException(function () use ($container) {
            $container->get("test");
        }, ServiceNotFoundException::class, "The container does not have service test");

        $container->lock();
        $this->assertTrue($container->isLocked());
        $this->assertThrowsException(function () use ($container) {
            $container->set("one", new stdClass());
        }, ContainerLockedException::class, "Service cannot be added/changed in a locked container");
        $this->assertThrowsException(function () use ($container) {
            $container->delete("one");
        }, ContainerLockedException::class, "Services cannot be deleted from a locked container");
    }
}
