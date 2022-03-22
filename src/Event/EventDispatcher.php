<?php

declare(strict_types=1);

namespace Flexible\Event;

use League\Event\ListenerPriority;

class EventDispatcher extends \League\Event\EventDispatcher implements EventDispatcherInterface
{
    public function subscribeTo(string $event, callable $listener, int $priority = ListenerPriority::NORMAL): void
    {
        parent::subscribeTo($event, $listener, $priority);
    }
}
