<?php

declare(strict_types=1);

namespace Flexible\Router;

use Flexible\Container\ContainerInterface;
use League\Route\Router as LeagueRouter;
use League\Route\Strategy\ApplicationStrategy;
use League\Route\Strategy\StrategyAwareInterface;
use League\Route\Strategy\StrategyInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Router implements RouterInterface
{
    private StrategyAwareInterface $router;

    public function __construct(ContainerInterface $container)
    {
        /** @var StrategyInterface $strategy */
        $strategy = (new ApplicationStrategy)->setContainer($container);
        $this->router = (new LeagueRouter)->setStrategy($strategy);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->router->handle($request);
    }

    public function delete(string $path, $handler): RouteInterface
    {
        $route = $this->router->delete($path, $handler);

        return new Route($route);
    }

    public function get(string $path, $handler): RouteInterface
    {
        $route = $this->router->get($path, $handler);

        return new Route($route);
    }

    public function group(array $routes): RouteGroup
    {

    }

    public function head(string $path, $handler): RouteInterface
    {
        $route = $this->router->head($path, $handler);

        return new Route($route);
    }

    public function map(string $method, string $path, $handler): RouteInterface
    {
    }

    public function options(string $path, $handler): RouteInterface
    {
        // TODO: Implement options() method.
    }

    public function patch(string $path, $handler): RouteInterface
    {
        // TODO: Implement patch() method.
    }

    public function post(string $path, $handler): RouteInterface
    {
        // TODO: Implement post() method.
    }

    public function put(string $path, $handler): RouteInterface
    {
        // TODO: Implement put() method.
    }
}
