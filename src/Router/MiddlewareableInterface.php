<?php

namespace Flexible\Router;

use Psr\Http\Server\MiddlewareInterface;

interface MiddlewareableInterface
{
    public function middleware(MiddlewareInterface $middleware): self;
}
