<?php

declare(strict_types=1);

namespace Tests;

use Flexible\App;
use Flexible\Container\ContainerInterface;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    protected App $app;

    public function setUp(): void
    {
        $this->app = App::create();

        parent::setUp();
    }

    /** @test */
    public function itShouldCreateAnApp(): void
    {
        $this->assertInstanceOf(App::class, $this->app);
    }

    public function itShouldReturnAServiceContainer(): void
    {
        $this->assertInstanceOf(ContainerInterface::class, $this->app->container());
    }
}
