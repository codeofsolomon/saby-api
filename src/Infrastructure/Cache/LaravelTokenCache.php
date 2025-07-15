<?php

declare(strict_types=1);

namespace SabyApi\Infrastructure\Cache;

use Illuminate\Contracts\Cache\Repository as CacheRepository;
use SabyApi\Application\Contracts\Cache\TokenCacheInterface;

final readonly class LaravelTokenCache implements TokenCacheInterface
{
    public function __construct(
        private readonly CacheRepository $cache
    ) {}

    public function remember(string $cacheKey, int $ttlSeconds, callable $callback): string
    {
        /** @var string $token */
        $token = $this->cache->remember($cacheKey, $ttlSeconds, $callback);

        return $token;
    }
}
