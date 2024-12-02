<?php

namespace Italofantone\ApiTokenValidator\Tests;

use Italofantone\ApiTokenValidator\ApiTokenValidatorServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->app->register(ApiTokenValidatorServiceProvider::class);        
    }    
}