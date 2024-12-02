# About ApiTokenValidator

A simple package to validate API tokens with Laravel. Middleware to protect routes using valid tokens.

> ⚠️ This code was used for educational purposes [...]

### Installation

You can install the package via composer. Run the following command:

```
composer require italofantone/api-token-validator
```

### Usage

File .env: `API_TOKEN_VALIDATOR=secret`.

```
<?php

use Illuminate\Support\Facades\Route;
use Italofantone\ApiTokenValidator\Http\Middleware\EnsureApiTokenIsValid;

Route::get('protected-route', function () {
    return response()->json([
        'message' => 'You are authorized to access this route!',
    ]);
})
->middleware(EnsureApiTokenIsValid::class)
->name('protected-route');
```

## Contact

- **Email**: [i@rimorsoft.com](mailto:i@rimorsoft.com)
- **Twitter**: [@italofantone](https://twitter.com/italofantone)
- **LinkedIn**: [italofantone](https://linkedin.com/in/italofantone)

## Donations

If you find this project useful and would like to support its development, you can make a donation via PayPal:

- **PayPal:** [Donate via PayPal](https://paypal.me/italofantone)

Thank you for your support!