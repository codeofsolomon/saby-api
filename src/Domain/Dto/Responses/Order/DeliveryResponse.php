<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Responses\Order;

final readonly class DeliveryResponse
{
    public function __construct(
        public ?string $address,
        public ?string $addressJSON,
        public ?float $changeAmount,
        public ?int $courierId,
        public ?string $courierName,
        public ?int $district,
        public ?string $externalId,
        public ?bool $isPickup,
        public ?int $paymentType,
        public ?int $persons,
        public ?string $recipient,
    ) {}

    /**
     * @param array{
     *   address: string,
     *   addressJSON: string,
     *   changeAmount?: float|null,
     *   courierId?: int|null,
     *   courierName?: string,
     *   district?: int|null,
     *   externalId?: string|null,
     *   isPickup: bool,
     *   paymentType: int,
     *   persons: int,
     *   recipient: string
     * } $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            address: (string) ($data['address'] ?? ''),
            addressJSON: (string) ($data['addressJSON'] ?? ''),
            changeAmount: isset($data['changeAmount']) ? (float) $data['changeAmount'] : null,
            courierId: isset($data['courierId']) ? (int) $data['courierId'] : null,
            courierName: (string) ($data['courierName'] ?? ''),
            district: isset($data['district']) ? (int) $data['district'] : null,
            externalId: $data['externalId'] ?? null,
            isPickup: (bool) ($data['isPickup'] ?? false),
            paymentType: (int) ($data['paymentType'] ?? 0),
            persons: (int) ($data['persons'] ?? 0),
            recipient: (string) ($data['recipient'] ?? ''),
        );
    }
}
