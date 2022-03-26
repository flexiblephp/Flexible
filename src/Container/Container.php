<?php

declare(strict_types=1);

namespace Flexible\Container;

use League\Container\Container as LeagueContainer;
use League\Container\Exception\ContainerException as LeagueContainerException;
use League\Container\Exception\NotFoundException as LeagueNotFoundException;
use League\Container\ReflectionContainer;

class Container implements ContainerInterface
{
    private LeagueContainer $container;

    public function __construct()
    {
        $this->container = new LeagueContainer();

        // register the reflection container as a delegate to enable auto wiring
        $this->container->delegate(
            new ReflectionContainer(true)
        );
    }

    public function get(string $id)
    {
        try {
            return $this->container->get($id);
        } catch (LeagueNotFoundException $e) {
            throw new NotFoundException(
                $e->getMessage(),
                $e->getCode(),
                $e->getPrevious()
            );
        } catch (LeagueContainerException $e) {
            throw new ContainerException(
                $e->getMessage(),
                $e->getCode(),
                $e->getPrevious()
            );
        }
    }

    public function has(string $id): bool
    {
        return $this->container->has($id);
    }

    public function bind(string $abstraction, string $implementation, array $arguments = []): void
    {
        $this->container->add($abstraction, $implementation);

        if (count($arguments) > 0) {
            $this->container->extend($abstraction)->addArguments($arguments);
        }
    }

    public function singleton(string $abstraction, string $implementation, array $arguments = []): void
    {
        $this->container->addShared($abstraction, $implementation);

        if (count($arguments) > 0) {
            $this->container->extend($abstraction)->addArguments($arguments);
        }
    }
}
