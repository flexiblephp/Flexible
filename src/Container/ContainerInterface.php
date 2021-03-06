<?php

namespace Flexible\Container;

use Psr\Container\ContainerInterface as PsrContainerInterface;

interface ContainerInterface extends PsrContainerInterface
{
    public function bind(string $abstraction, string $implementation, array $arguments = []): void;

    public function singleton(string $abstraction, string $implementation, array $arguments = []): void;
}
