<?php

declare(strict_types=1);

namespace SabyApi\Infrastructure\Auth;

use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\RequestFactoryInterface;
use SabyApi\Application\Contracts\Auth\AuthenticatorInterface;
use SabyApi\Application\Contracts\Cache\TokenCacheInterface;
use SabyApi\Application\Contracts\Http\ApiClientInterface;
use SabyApi\Domain\Exceptions\UnauthorizedException;

final class TokenAuthenticator implements AuthenticatorInterface
{
    private const CACHE_KEY = 'saby_api:access_token';

    public function __construct(
        private ApiClientInterface $api,
        private TokenCacheInterface $cache,
        private readonly RequestFactoryInterface $requestFactory,
        private string $appClientId,
        private string $appSecret,
        private string $secretKey,
        private readonly int $ttlFallback // «запас» до истечения
    ) {}

    public function token(): string
    {
        return $this->cache->remember(
            self::CACHE_KEY,
            $this->ttlFallback,
            fn () => $this->requestNewToken()
        );
    }

    private function requestNewToken(): string
    {
        $req = $this->requestFactory->createRequest('POST', 'oauth/service/')
            ->withHeader('Content-Type', 'application/json')
            ->withBody(Utils::streamFor(json_encode([
                'app_client_id' => $this->appClientId,
                'app_secret' => $this->appSecret,
                'secret_key' => $this->secretKey,
            ], JSON_THROW_ON_ERROR)));

        $res = $this->api->send($req);

        if ($res->getStatusCode() !== 200) {
            throw new UnauthorizedException('Unable to fetch access token');
        }

        /** @var array{token:string,expiresIn:int} $data */
        $data = json_decode((string) $res->getBody(), true, 512, JSON_THROW_ON_ERROR);

        return $data['access_token'];
    }
}
