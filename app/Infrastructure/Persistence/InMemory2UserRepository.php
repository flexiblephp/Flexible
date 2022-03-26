<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\User;
use App\Domain\UserRepositoryInterface;

class InMemory2UserRepository implements UserRepositoryInterface
{
    /** @var array<User>  */
    private array $users;

    public function __construct()
    {
        $this->users[] = new User("1", "Júlia");
        $this->users[] = new User("2", "Ivet");
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
