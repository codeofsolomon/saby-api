<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Responses\Order;

/**
 * Информация о покупателе
 */
final readonly class CustomerResponse
{
    public function __construct(
        public ?bool $blacklisted,
        public ?string $name,
        public ?string $phone,
    ) {}

    /** @param array{blacklisted: bool, name: string, phone: string} $data */
    public static function fromArray(array $data): self
    {
        return new self(
            blacklisted: (bool) ($data['blacklisted'] ?? false),
            name: (string) ($data['name'] ?? ''),
            phone: (string) ($data['phone'] ?? ''),
        );
    }
}
