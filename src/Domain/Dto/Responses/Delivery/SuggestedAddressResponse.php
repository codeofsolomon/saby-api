<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Responses\Delivery;

/**
 * Ответ API: массив предложенных адресов
 *
 * @property SuggestedAddress[] $addresses
 */
final readonly class SuggestedAddressResponse
{
    /**
     * @param  SuggestedAddress[]  $addresses
     */
    public function __construct(
        public array $addresses,
    ) {}

    /**
     * @param  array{addresses: array<array>}  $data
     */
    public static function fromArray(array $data): self
    {
        $list = [];
        foreach ($data['addresses'] ?? [] as $item) {
            $list[] = SuggestedAddress::fromArray($item);
        }

        return new self(
            addresses: $list,
        );
    }
}
