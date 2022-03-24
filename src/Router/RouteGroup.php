<?php

declare(strict_types=1);

namespace Flexible\Router;

class RouteGroup
{
    use Middlewareable;

    private string $prefix;

    public function prefix(string $prefix): self
    {
        $this->prefix = $prefix;

        return $this;
    }
}
