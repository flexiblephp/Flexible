<?php

namespace App\Domain;

interface UserRepositoryInterface
{
    public function get(string $id): ?User;
}
