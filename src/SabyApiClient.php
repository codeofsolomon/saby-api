<?php

declare(strict_types=1);

namespace SabyApi;

use Illuminate\Support\Str;
use Psr\Http\Message\RequestFactoryInterface;
use SabyApi\Application\Contracts\Http\ApiClientInterface;
use SabyApi\Application\Services\BaseService;
use SabyApi\Infrastructure\Auth\TokenAuthenticator;

class SabyApiClient
{
    public function __construct(
        protected ApiClientInterface $api,
        protected TokenAuthenticator $auth
    ) {}

    public function __call(string $name, array $arguments): BaseService
    {
        $class = __NAMESPACE__.'\\Application\\Services\\'.Str::studly($name).'Service';

        return new $class(
            $this->api,
            $this->auth,
            app(RequestFactoryInterface::class)
        );
    }
}
