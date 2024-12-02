<?php

namespace Italofantone\ApiTokenValidator;

use Illuminate\Support\ServiceProvider;

class ApiTokenValidatorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/api-token-validator.php', 'api-token-validator'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/api-token-validator.php' => config_path('api-token-validator.php'),
        ], 'api-token-validator-config');

        if ($this->app->environment('testing')) {
            $this->loadTestRoutes();
        }
    }

    protected function loadTestRoutes()
    {
        \Illuminate\Support\Facades\Route::get('/api/protected-route', function () {
            return response()->json(['message' => 'You have access!'], 200);
        })
            ->middleware(\Italofantone\ApiTokenValidator\Http\Middleware\EnsureApiTokenIsValid::class);
    }
}
