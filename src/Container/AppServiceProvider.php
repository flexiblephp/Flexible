<?php

declare(strict_types=1);

namespace Flexible\Container;

use App\Domain\UserRepositoryInterface;
use App\Infrastructure\Persistence\InMemoryUserRepository;

class AppServiceProvider extends AbstractServiceProvider
{
    public function boot(): void
    {
        $this->container()->bind(
            UserRepositoryInterface::class,
            InMemoryUserRepository::class
        );
    }

    public function register(): void
    {

    }
}
