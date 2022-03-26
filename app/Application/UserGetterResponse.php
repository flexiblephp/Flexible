<?php

declare(strict_types=1);

namespace App\Application;

class UserGetterResponse
{
    public function __construct(
        private string $id,
        private string $name
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}
