<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Responses\Order;

/**
 * Детальный ответ с информацией о заказе
 */
final readonly class OrderDetailsResponse
{
    /** @param OrderNomenclature[] $nomenclatures */
    public function __construct(
        public ?string $id,
        public ?string $key,
        public ?string $saleKey,
        public string $number,
        public ?int $pointId,
        public ?string $comment,
        public ?CustomerResponse $customer,
        public ?\DateTimeImmutable $datetime,
        public ?array $nomenclatures,
        public ?DeliveryResponse $delivery,
        public ?int $paymentType,
        public ?float $totalPrice,
        public ?float $totalSum,
        public ?float $totalDiscount,
        public ?array $promoCode,
        public ?array $additionalFields,
    ) {}

    /**
     * @param array{
     *   id: string,
     *   key: string,
     *   saleKey: string,
     *   number: string,
     *   pointId: int,
     *   comment: string,
     *   customer: array,
     *   datetime: string,
     *   nomenclatures: array<array>,
     *   delivery: array,
     *   paymentType: int,
     *   totalPrice: float|string,
     *   totalSum: float|string,
     *   totalDiscount?: float|string|null,
     *   promoCode: array,
     *   additionalFields: array
     * } $data
     */
    public static function fromArray(array $data): self
    {
        // parse nomenclatures
        $items = [];
        foreach ($data['nomenclatures'] ?? [] as $row) {
            $items[] = OrderNomenclature::fromArray($row);
        }

        return new self(
            id: (string) $data['id'],
            key: (string) $data['key'],
            saleKey: (string) $data['saleKey'],
            number: (string) $data['number'],
            pointId: (int) $data['pointId'],
            comment: (string) $data['comment'],
            customer: CustomerResponse::fromArray($data['customer'] ?? []),
            datetime: new \DateTimeImmutable($data['datetime']),
            nomenclatures: $items,
            delivery: DeliveryResponse::fromArray($data['delivery'] ?? []),
            paymentType: (int) $data['paymentType'],
            totalPrice: (float) $data['totalPrice'],
            totalSum: (float) $data['totalSum'],
            totalDiscount: isset($data['totalDiscount']) ? (float) $data['totalDiscount'] : null,
            promoCode: $data['promoCode'] ?? [],
            additionalFields: $data['additionalFields'] ?? [],
        );
    }
}
