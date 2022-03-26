<?php

declare(strict_types=1);

namespace App;

class TestListener
{
    public function __invoke()
    {
        // echo(microtime(true) - FLEXIBLE_START);
    }
}
