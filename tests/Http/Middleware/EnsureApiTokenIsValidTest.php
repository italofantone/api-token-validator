<?php

namespace Italofantone\ApiTokenValidator\Tests\Http\Middleware;

use Italofantone\ApiTokenValidator\Http\Middleware\EnsureApiTokenIsValid;
use Italofantone\ApiTokenValidator\Tests\TestCase;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class EnsureApiTokenIsValidTest extends TestCase
{
    public function test_valid_token_allows_request_to_continue()
    {
        Config::set('api-token-validator.token', 'valid-token');

        $middleware = new EnsureApiTokenIsValid();

        $request = new Request();
        $request->headers->set('Authorization', 'Bearer valid-token');

        $response = $middleware->handle($request, function (Request $request) {
            return 'next middleware';
        });

        $this->assertEquals('next middleware', $response);
    }

    public function test_invalid_token_returns_401()
    {
        Config::set('api-token-validator.token', 'valid-token');

        $middleware = new EnsureApiTokenIsValid();

        $request = new Request();
        $request->headers->set('Authorization', 'invalid-token');

        $response = $middleware->handle($request, function (Request $request) {});

        $this->assertJson($response->getContent());
        $this->assertStringContainsString('Unauthorized', $response->getContent());
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }
}
