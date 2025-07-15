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
