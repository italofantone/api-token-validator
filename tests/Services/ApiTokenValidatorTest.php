<?php

namespace Italofantone\ApiTokenValidator\Tests\Services;

use Italofantone\ApiTokenValidator\Services\ApiTokenValidator;
use Italofantone\ApiTokenValidator\Tests\TestCase;
use Illuminate\Support\Facades\Config;

class ApiTokenValidatorTest extends TestCase
{
    public function test_valid_token_returns_true()
    {
        Config::set('api-token-validator.token', 'valid-token');

        $validator = new ApiTokenValidator();
        $this->assertTrue($validator->validate('valid-token'));
    }

    public function test_invalid_token_returns_false()
    {
        Config::set('api-token-validator.token', 'valid-token');

        $validator = new ApiTokenValidator();
        $this->assertFalse($validator->validate('invalid-token'));
    }
}
