<?php

declare(strict_types=1);

namespace Flexible\Container;

use League\Container\ServiceProvider\AbstractServiceProvider as LeagueAbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

abstract class AbstractServiceProvider extends LeagueAbstractServiceProvider implements BootableServiceProviderInterface
{
    protected $flexibleContainer;

    public function container(ContainerInterface $container = null): ContainerInterface
    {
        if (null === $container) {
            return $this->flexibleContainer;
        }

        return $this->flexibleContainer = $container;
    }

    public function provides(string $id): bool
    {
        $services = [
            'key'
        ];

        return in_array($id, $services);
    }
}
