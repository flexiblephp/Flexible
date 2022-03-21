<?php

declare(strict_types=1);

namespace Flexible;

use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class App implements RequestHandlerInterface
{
    private function __construct(
        private ContainerInterface $container,
        private RouterInterface $router,
        private ResponseFactoryInterface $responseFactory
    ) {
    }

    public static function create(
        ?ContainerInterface $container = null,
        ?RouterInterface $router = null,
        ?ResponseFactoryInterface $responseFactory = null
    ): self {
        $container = $container ?? new Container();
        $router = $router ?? new Router($container);
        $responseFactory = $responseFactory ?? new ResponseFactory();

        return new self(
            $container,
            $router,
            $responseFactory
        );
    }

    public function container(): ContainerInterface
    {
        return $this->container;
    }

    public function router(): RouterInterface
    {
        return $this->router;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $response = $this->router->handle($request); // resolvers to handler using congainer, applies middlewares...

        /**
         * This is to be in compliance with RFC 2616, Section 9.
         * If the incoming request method is HEAD, we need to ensure that the response body
         * is empty as the request may fall back on a GET route handler due to FastRoute's
         * routing logic which could potentially append content to the response body
         * https://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html#sec9.4
         */
        $method = strtoupper($request->getMethod());
        if ('HEAD' === $method) {
            $emptyBody = $this->responseFactory->createResponse()->getBody();

            return $response->withBody($emptyBody);
        }

        return $response;
    }

    public function dispatch(ResponseInterface $response): void
    {
        (new SapiEmitter())->emit($response);

        // $this->eventDispatcher()->dispatch(new FlexibleHasTerminated()); // TODO FW events
    }
}
