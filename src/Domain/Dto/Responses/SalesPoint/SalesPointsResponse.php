<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Responses\SalesPoint;

/**
 * Ответ API Saby Retail: список точек продаж
 *
 * @property SalesPoint[] $salesPoints
 * @property bool $hasMore Флаг, что есть следующая страница
 */
final readonly class SalesPointsResponse
{
    /** @param SalesPoint[] $salesPoints */
    public function __construct(
        public array $salesPoints,
        public bool $hasMore,
    ) {}

    /**
     * @param  array{
     *     salesPoints: array<array>,
     *     outcome: array{hasMore: bool}
     * } $data
     */
    public static function fromArray(array $data): self
    {
        $points = array_map(
            static fn (array $item): SalesPoint => SalesPoint::fromArray($item),
            $data['salesPoints'] ?? []
        );

        $hasMore = isset($data['outcome']['hasMore'])
            ? (bool) $data['outcome']['hasMore']
            : false;

        return new self(
            salesPoints: $points,
            hasMore: $hasMore,
        );
    }
}
