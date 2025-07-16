<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Responses\Delivery;

final readonly class DeliveryCostResponse
{
    public function __construct(
        public ?float $cost,
        public ?float $costForFreeDelivery,
        public ?int $district,
        public ?float $minDeliverySum,
        public ?string $geoCoords,
        public ?float $lat,
        public ?float $lon,
    ) {}

    /**
     * Гидратор из массива ответа
     *
     * @param array{
     *   cost: float,
     *   costForFreeDelivery: float,
     *   district: int,
     *   minDeliverySum: float,
     *   geoCoords: string,
     *   lat: float,
     *   lon: float
     * } $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            cost: (float) $data['cost'],
            costForFreeDelivery: (float) $data['costForFreeDelivery'],
            district: (int) $data['district'],
            minDeliverySum: (float) $data['minDeliverySum'],
            geoCoords: (string) $data['geoCoords'],
            lat: (float) $data['lat'],
            lon: (float) $data['lon'],
        );
    }
}
