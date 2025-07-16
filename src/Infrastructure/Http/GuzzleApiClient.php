<?php

declare(strict_types=1);

namespace SabyApi\Infrastructure\Http;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use SabyApi\Application\Contracts\Http\ApiClientInterface;

class GuzzleApiClient implements ApiClientInterface
{
    public function __construct(
        private readonly Guzzle $guzzle,
        private readonly LoggerInterface $logger
    ) {}

    public static function build(string $baseUri, float $timeout, LoggerInterface $logger): self
    {
        $stack = HandlerStack::create();
        $stack->push(Middleware::retry(
            static fn (
                int $retries,
                RequestInterface $request,
                ?ResponseInterface $response
            ): bool => $retries < 2 && ($response?->getStatusCode() ?? 0) >= 500
        ));

        $guzzle = new Guzzle([
            'base_uri' => $baseUri,
            'timeout' => $timeout,
            'handler' => $stack,
        ]);

        return new self($guzzle, $logger);
    }

    public function send(RequestInterface $request): ResponseInterface
    {
        $this->logger->debug('[saby] REQUEST', [
            'method' => $request->getMethod(),
            'uri' => (string) $request->getUri(),
        ]);

        $response = $this->guzzle->send($request);

        $this->logger->debug('[saby] RESPONSE', [
            'code' => $response->getStatusCode(),
        ]);

        return $response;
    }
}
