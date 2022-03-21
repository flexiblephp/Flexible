<?php

declare(strict_types=1);

namespace Flexible;

use League\Container\Container as LeagueContainer;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class Container implements ContainerInterface
{
    private LeagueContainer $container;

    public function __construct()
    {
        $this->container = new LeagueContainer();
    }

    public function get(string $id)
    {
        return $this->container->get($id);
    }

    public function has(string $id): bool
    {
        return $this->container->has($id);
    }

    public function bind(string $abstraction, string $implementation): void
    {
        $this->container->add($abstraction, $implementation);
    }

    public function singleton(string $abstraction, string $implementation): void
    {
        $this->container->addShared($abstraction, $implementation);
    }
}
