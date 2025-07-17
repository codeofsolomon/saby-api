<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Responses\Order;

final readonly class OrderNomenclature
{
    /** @param array<array> $modifiers */
    public function __construct(
        public ?float $cost,
        public ?float $count,
        public ?string $externalId,
        public ?array $modifiers,
        public ?string $name,
        public ?string $nomNumber,
        public ?int $rowNumber,
        public ?float $totalPrice,
        public ?float $totalSum,
    ) {}

    /**
     * @param array{
     *   cost: float|string,
     *   count: float|string,
     *   externalId: string,
     *   modifiers: array<array>,
     *   name: string,
     *   nomNumber: string,
     *   rowNumber: int,
     *   totalPrice: float|string,
     *   totalSum: float|string
     * } $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            cost: (float) ($data['cost'] ?? 0.0),
            count: (float) ($data['count'] ?? 0.0),
            externalId: (string) ($data['externalId'] ?? ''),
            modifiers: $data['modifiers'] ?? [],
            name: (string) ($data['name'] ?? ''),
            nomNumber: (string) ($data['nomNumber'] ?? ''),
            rowNumber: (int) ($data['rowNumber'] ?? 0),
            totalPrice: (float) ($data['totalPrice'] ?? 0.0),
            totalSum: (float) ($data['totalSum'] ?? 0.0),
        );
    }
}
