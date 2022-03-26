<?php

declare(strict_types=1);

namespace Flexible;

use Flexible\Container\Container;
use Flexible\Container\ContainerInterface;
use Flexible\Router\RouterInterface;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class App implements RequestHandlerInterface
{
    public const VERSION = 'dev';

    private ResponseFactoryInterface $responseFactory;
    private RouterInterface $router;
    private EventDispatcherInterface $eventDispatcher;

    private function __construct(private ContainerInterface $container)
    {
    }

    public static function create(?ContainerInterface $container = null): self
    {
        $container = $container ?? new Container();

        return new self($container);
    }

    public function container(): ContainerInterface
    {
        return $this->container;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function eventDispatcher(): EventDispatcherInterface
    {
        return $this->eventDispatcher ?? $this->container->get(EventDispatcherInterface::class);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function responseFactory(): ResponseFactoryInterface
    {
        return $this->responseFactory ?? $this->container->get(ResponseFactoryInterface::class);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function router(): RouterInterface
    {
        return $this->router ?? $this->container->get(RouterInterface::class);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $response = $this->router()->handle($request);

        /**
         * This is to be in compliance with RFC 2616, Section 9.
         * If the incoming request method is HEAD, we need to ensure that the response body
         * is empty as the request may fall back on a GET route handler due to FastRoute's
         * routing logic which could potentially append content to the response body
         * https://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html#sec9.4
         */
        $method = strtoupper($request->getMethod());
        if ('HEAD' === $method) {
            $emptyBody = $this->responseFactory()->createResponse()->getBody();

            return $response->withBody($emptyBody);
        }

        return $response;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function dispatch(ResponseInterface $response): void
    {
        (new SapiEmitter())->emit($response);

        // TODO put events in the request flow $this->eventDispatcher()->dispatch(new FlexibleHasTerminated());
    }

    public function version(): string
    {
        return self::VERSION;
    }
}
