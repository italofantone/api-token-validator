<?php

namespace Italofantone\ApiTokenValidator\Tests;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;

class ApiTokenValidatorTest extends TestCase
{
    public function test_valid_api_token()
    {
        $validToken = 'valid-token';
        $bearerToken = 'Bearer ' . $validToken;

        Config::set('api-token-validator.token', $validToken);        

        $this->withHeaders([
            'Authorization' => $bearerToken,
        ])
            ->json('GET', '/api/protected-route')
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_invalid_api_token()
    {
        Config::set('api-token-validator.token', 'valid-token');

        $this->withHeaders([
            'Authorization' => 'Bearer invalid-token',
        ])
            ->json('GET', '/api/protected-route')
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_missing_api_token()
    {
        $this
            ->json('GET', '/api/protected-route')
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
