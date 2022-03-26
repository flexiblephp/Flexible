<?php

declare(strict_types=1);

namespace App\Infrastructure\Controllers;

use App\Application\UserGetter;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetUserController
{
    public function __construct(
        private UserGetter $userGetter,
        private ResponseFactoryInterface $responseFactory
    ) {
    }

    public function __invoke(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $userGetterResponse = $this->userGetter->__invoke($args['id']);
        $response = $this->responseFactory->createResponse();
        $response->getBody()->write(json_encode($userGetterResponse->toArray()));

        return $response->withStatus(200)->withHeader('Content-type', 'application/json');
    }
}
