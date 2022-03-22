<?php

namespace Flexible\Router;

use Psr\Http\Server\RequestHandlerInterface;

interface RouterInterface extends RequestHandlerInterface
{
    public function delete(string $path, $handler): RouteInterface;

    public function get(string $path, $handler): RouteInterface;

    public function head(string $path, $handler): RouteInterface;

    public function map(string $method, string $path, $handler): RouteInterface;

    public function options(string $path, $handler): RouteInterface;

    public function patch(string $path, $handler): RouteInterface;

    public function post(string $path, $handler): RouteInterface;

    public function put(string $path, $handler): RouteInterface;
}
