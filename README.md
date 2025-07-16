# Laravel Saby API

Unofficial Laravel SDK for the Saby API.

## Requirements

* PHP 8.2 or higher
* Laravel 10.x, 11.x, or 12.x
* Composer
* Guzzle HTTP 7.9+
* PSR HTTP Client & PSR HTTP Message

## Installation

Install via Composer:

```bash
composer require codeofsolomon/laravel-saby-api
```

This package will be auto-discovered by Laravel via the service provider configured in `composer.json`.

## Publishing Configuration

Publish the configuration file with:

```bash
php artisan vendor:publish --tag=saby-api-config
```

This creates a `config/saby-api.php` file.

## Configuration

In your `.env` file, add the following:

```bash
SABY_APP_CLIENT_ID=your-client-id
SABY_APP_SECRET=your-app-secret
SABY_SECRET_KEY=your-secret-key
SABY_BASE_URI=https://api.sbis.ru/retail/
SABY_AUTH_URL=https://online.sbis.ru/oauth/service/
SABY_CLOUD_TIMEOUT=20.0
SABY_TOKEN_TTL=3540
SABY_CACHE_STORE=null
```

You can customize other settings in `config/saby-api.php`:

```php
<?php

return [

    'app_client_id' => env('SABY_APP_CLIENT_ID'),
    'app_secret' => env('SABY_APP_SECRET'),
    'secret_key' => env('SABY_SECRET_KEY'),

    'base_uri' => env('SABY_BASE_URI', 'https://api.sbis.ru/retail/'),
    'auth_url' => env('SABY_AUTH_URL'.'https://online.sbis.ru/oauth/service/'),
    'timeout' => env('SABY_CLOUD_TIMEOUT', 20.0),

    'token_cache_ttl' => env('SABY_TOKEN_TTL', 60 * 59), // 59 мин
    'cache_store' => env('SABY_CACHE_STORE', null),        // null → driver по-умолчанию
];

```

## Contributing

Contributions are welcome! Please open an issue or submit a pull request.

## License

This package is open-sourced under the MIT license. See the [LICENSE](LICENSE) file for details.
