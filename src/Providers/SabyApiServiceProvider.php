<?php

declare(strict_types=1);

namespace SabyApi\Providers;

use Illuminate\Cache\CacheManager;
use Illuminate\Contracts\Config\Repository as ConfigRepo;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\RequestFactoryInterface;
use SabyApi\Application\Contracts\Auth\AuthenticatorInterface;
use SabyApi\Application\Contracts\Cache\TokenCacheInterface;
use SabyApi\Application\Contracts\Http\ApiClientInterface;
use SabyApi\Infrastructure\Auth\TokenAuthenticator;
use SabyApi\Infrastructure\Cache\LaravelTokenCache;
use SabyApi\Infrastructure\Http\GuzzleApiClient;
use SabyApi\SabyApiClient;

class SabyApiServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/saby-api.php' => config_path('saby-api.php'),
            ], 'saby-api-config');
        }
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        /** @var ConfigRepo $config */
        $config = $this->app['config'];

        $this->app->singleton(RequestFactoryInterface::class, fn () => new Psr17Factory);

        // 1) low-level HTTP client
        $this->app->singleton(ApiClientInterface::class, function () use ($config) {
            return GuzzleApiClient::build(
                baseUri: $config->get('saby-api.base_uri'),
                timeout: (float) $config->get('saby-api.timeout'),
                logger: $this->app->make(\Psr\Log\LoggerInterface::class)
            );
        });

        // 2) token cache
        $this->app->bind(TokenCacheInterface::class, function () use ($config) {
            /** @var CacheManager $cache */
            $cache = $this->app->make(CacheManager::class);

            return new LaravelTokenCache(
                $config->get('saby-api.cache_store')
                    ? $cache->store($config->get('saby-api.cache_store'))
                    : $cache->store()
            );
        });

        // 3) authenticator
        $this->app->singleton(AuthenticatorInterface::class, function () use ($config) {
            return new TokenAuthenticator(
                api          : $this->app->make(ApiClientInterface::class),
                cache        : $this->app->make(TokenCacheInterface::class),
                requestFactory: $this->app->make(RequestFactoryInterface::class),
                appClientId: $config->get('saby-api.app_client_id'),
                appSecret: $config->get('saby-api.app_secret'),
                secretKey: $config->get('saby-api.secret_key'),
                ttlFallback  : (int) $config->get('saby-api.token_cache_ttl')
            );
        });

        // 4) facade-like main client
        $this->app->singleton(SabyApiClient::class, fn () => new SabyApiClient(
            $this->app->make(ApiClientInterface::class),
            $this->app->make(AuthenticatorInterface::class)
        ));

        $this->app->alias(SabyApiClient::class, 'saby-api');
    }
}
