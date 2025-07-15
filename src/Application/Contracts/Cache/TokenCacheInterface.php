<?php

declare(strict_types=1);

namespace SabyApi\Application\Contracts\Cache;

interface TokenCacheInterface
{
    public function remember(string $cacheKey, int $ttlSeconds, callable $callback): string;
}
