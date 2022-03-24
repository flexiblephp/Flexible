<?php

declare(strict_types=1);

namespace Flexible\Middlewares;

use Flexible\Http\Response;
use Flexible\Http\ResponseFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Throwable;

class ErrorMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (Throwable $e) {
            // return $this->handleException($request, $e);

            $exceptionType = get_class($e);

            return new Response(
                500,
                ['Content-type' => 'application/json'],
                json_encode(['class' => $exceptionType])
            );
        }
    }

    private function handleException(ServerRequestInterface $request, Throwable $exception): ResponseInterface
    {
//        if ($exception instanceof HttpException) {
//            $request = $exception->getRequest();
//        }
//
//        $exceptionType = get_class($exception);
//        $handler = $this->getErrorHandler($exceptionType);
//
//        return $handler($request, $exception, $this->displayErrorDetails, $this->logErrors, $this->logErrorDetails);
    }
}
