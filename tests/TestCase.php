<?php

namespace Cweetagram\CweetagramVonageWhatsapp\Tests;

use \Orchestra\Testbench\TestCase as Orchestra;
use Spatie\LaravelData\LaravelDataServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            LaravelDataServiceProvider::class,
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        // Make sure services are booted
        $this->app->boot();
    }
}