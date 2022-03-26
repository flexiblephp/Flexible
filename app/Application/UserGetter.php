<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\UserNotFound;
use App\Domain\UserRepositoryInterface;

class UserGetter
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    /**
     * @throws UserNotFound
     */
    public function __invoke(string $id): UserGetterResponse
    {
        $user = $this->repository->get($id);

        if (null === $user) {
            throw new UserNotFound();
        }

        return new UserGetterResponse($user->id(), $user->name());
    }
}
