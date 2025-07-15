<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Responses\SalesPoint;

final readonly class Hall
{
    public function __construct(
        public int $id,
        public ?string $name,

    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: (int) $data['id'],
            name: $data['name'],

        );
    }
}
