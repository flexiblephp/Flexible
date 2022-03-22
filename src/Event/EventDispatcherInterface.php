<?php

namespace Flexible\Event;

use Psr\EventDispatcher\EventDispatcherInterface as PsrEventDispatcherInterface;

interface EventDispatcherInterface extends PsrEventDispatcherInterface
{
    public function subscribeTo(string $event, callable $listener, int $priority = 0): void;
}
