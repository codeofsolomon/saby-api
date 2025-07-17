<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Responses\Order;

use SabyApi\Domain\Enums\OrderStatus;

final readonly class OrderStatusResponse
{
    /** @param Payment[] $payments */
    public function __construct(
        public OrderStatus $state,
        public ?array $payments,
    ) {}

    /** @param array{state: int, payments: array<array>} $data */
    public static function fromArray(array $data): self
    {
        $payments = array_map(
            static fn (array $p) => Payment::fromArray($p),
            $data['payments'] ?? []
        );

        return new self(
            state: OrderStatus::from($data['state']),
            payments: $payments,
        );
    }
}
