<?php

declare(strict_types=1);

namespace Flexible\Router;

use Flexible\Router\RouteInterface;
use League\Route\Route as LeagueRoute;
use Psr\Http\Server\MiddlewareInterface;

class Route implements RouteInterface
{
    use Middlewareable;

    public function __construct(private LeagueRoute $route)
    {
    }
}
