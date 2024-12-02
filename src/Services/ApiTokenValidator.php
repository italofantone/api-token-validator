<?php

namespace Italofantone\ApiTokenValidator\Services;

class ApiTokenValidator
{
    /**
     * Validate the given token.
     *
     * @param string|null $token
     * @return bool
     */
    public function validate(?string $token): bool
    {
        $validToken = config('api-token-validator.token');

        return $token && $token === $validToken;
    }
}