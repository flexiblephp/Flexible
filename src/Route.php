<?php

declare(strict_types=1);

namespace Flexible;

use League\Route\Route as LeagueRoute;

class Route implements RouteInterface
{
    public function __construct(private LeagueRoute $route)
    {
    }
}
