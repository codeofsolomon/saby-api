<?php

declare(strict_types=1);

namespace SabyApi\Application\Services;

use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\RequestFactoryInterface;
use SabyApi\Application\Contracts\Auth\AuthenticatorInterface;
use SabyApi\Application\Contracts\Http\ApiClientInterface;

abstract class BaseService
{
    public function __construct(
        protected readonly ApiClientInterface $api,
        protected readonly AuthenticatorInterface $auth,
        protected readonly RequestFactoryInterface $requestFactory,
    ) {}

    final protected function authorizedRequest(
        string $method,
        string $uri,
        array $options = []
    ): mixed {
        $request = $this->requestFactory
            ->createRequest($method, $uri)
            ->withHeader('X-SBISAccessToken', $this->auth->token());

        if ($method !== 'GET') {
            $body = json_encode($options, JSON_THROW_ON_ERROR);

            $request = $request                         // ← сохраняем!
                ->withHeader('Content-Type', 'application/json')
                ->withHeader('Accept', 'application/json')
                ->withBody(Utils::streamFor($body));    // ← сохраняем!
        } elseif ($options) {
            $request = $request->withUri(
                $request->getUri()->withQuery(http_build_query($options))
            );
        }

        $response = $this->api->send($request);

        return json_decode((string) $response->getBody(), true);
    }
}
