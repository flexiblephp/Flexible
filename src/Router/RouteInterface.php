<?php

namespace Flexible\Router;

use Psr\Http\Server\MiddlewareInterface;

interface RouteInterface
{
    public function middleware(MiddlewareInterface $middleware): self;
}
