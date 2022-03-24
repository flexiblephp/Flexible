<?php

declare(strict_types=1);

namespace Flexible;

use App\Domain\UserRepositoryInterface;
use App\Infrastructure\Persistence\InMemoryUserRepository;
use Flexible\Container\AbstractServiceProvider;
use Flexible\Http\ResponseFactory;
use Flexible\Http\ResponseFactoryInterface;

class AppServiceProvider extends AbstractServiceProvider
{
    public function boot(): void
    {
        $this->container()->bind(ResponseFactoryInterface::class, ResponseFactory::class);
    }

    public function register(): void
    {

    }
}
