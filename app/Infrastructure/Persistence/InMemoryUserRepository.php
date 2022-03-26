<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\User;
use App\Domain\UserRepositoryInterface;

class InMemoryUserRepository implements UserRepositoryInterface
{
    /** @var array<User>  */
    private array $users;

    public function __construct()
    {
        $this->users[] = new User("1", "Marc");
        $this->users[] = new User("2", "Anna");
    }

    public function get(string $id): ?User
    {
        /** @var User $user */
        foreach($this->users as $user) {
            if ($id === $user->id()) {
                return $user;
            }
        }

        return null;
    }
}
