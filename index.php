<?php

use App\Domain\UserRepositoryInterface;
use App\Infrastructure\Controllers\GetUserController;
use App\Infrastructure\Persistence\InMemory2UserRepository;
use App\Infrastructure\Persistence\InMemoryUserRepository;
use Flexible\App;
use Flexible\Event\EventDispatcherInterface;
use Flexible\Router\RouterInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Log\LoggerInterface;

define('FLEXIBLE_START', microtime(true));

require __DIR__ . '/vendor/autoload.php';

$app = App::create();

$app->container()->singleton(
    EventDispatcherInterface::class,
    \League\Event\EventDispatcher::class
);
$app->container()->singleton(
    LoggerInterface::class,
    \Monolog\Logger::class
);
$app->container()->bind(
    ResponseFactoryInterface::class,
    \Laminas\Diactoros\ResponseFactory::class
);
$app->container()->singleton(
    RouterInterface::class,
    \Flexible\Router\Router::class,
    [$app->container()]
);
// $app->eventDispatcher()->subscribeTo(\Flexible\Event\FlexibleHasTerminated::class, new \App\TestListener());

$app->container()->bind(
    UserRepositoryInterface::class,
    InMemoryUserRepository::class
);

$app->router()->get('/hello', function () {
    $responseFactory = new \Laminas\Diactoros\ResponseFactory();
    $response = $responseFactory->createResponse();
    $response->getBody()->write("Hello, world");

    return $response->withStatus(200);
});

$app->router()->get('/users/{id}', GetUserController::class);

$app->dispatch(
    $app->handle(\Laminas\Diactoros\ServerRequestFactory::fromGlobals())
);
