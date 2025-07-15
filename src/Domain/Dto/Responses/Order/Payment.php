<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Responses\Order;

final readonly class Payment
{
    public function __construct(
        public ?float $amount,
        public ?string $paymentType,
        public ?bool $isClosed,
        public ?string $errorMessage,
    ) {}

    /** @param array{amount: float, paymentType: string, isClosed: bool, errorMessage?: string} $data */
    public static function fromArray(array $data): self
    {
        return new self(
            amount: $data['amount'],
            paymentType: $data['paymentType'],
            isClosed: $data['isClosed'],
            errorMessage: $data['errorMessage'] ?? null,
        );
    }
}
