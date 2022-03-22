<?php

declare(strict_types=1);

namespace Flexible\Router;

use Flexible\Router\RouteInterface;
use League\Route\Route as LeagueRoute;
use Psr\Http\Server\MiddlewareInterface;

class Route implements RouteInterface
{
    public function __construct(private LeagueRoute $route)
    {
    }

    public function middleware(MiddlewareInterface $middleware): self
    {
        $this->route->middleware($middleware);

        return $this;
    }
}
