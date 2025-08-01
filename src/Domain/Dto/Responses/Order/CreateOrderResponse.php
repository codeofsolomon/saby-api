<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Responses\Order;

final readonly class CreateOrderResponse
{
    /** @param OrderNomenclature[] $nomenclatures */
    public function __construct(
        public int $resultCode,
        public ?string $paymentRef,
        public ?string $orderNumber,
        public ?string $saleKey,
        public ?string $message,
        public ?string $id,
        public ?string $key,
        public ?string $number,
        public int $pointId,
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
     *   resultCode: int,
     *   paymentRef: string|null,
     *   orderNumber: string,
     *   saleKey: string,
     *   message: string|null,
     *   id: string,
     *   key: string,
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
        // Nomenclatures
        $nomenclatures = [];
        foreach ($data['nomenclatures'] ?? [] as $item) {
            $nomenclatures[] = OrderNomenclature::fromArray($item);
        }

        // PromoCode and AdditionalFields
        $promoCode = $data['promoCode'] ?? [];
        $additionalFields = $data['additionalFields'] ?? [];

        return new self(
            resultCode: (int) $data['resultCode'],
            paymentRef: $data['paymentRef'] ?? null,
            orderNumber: (string) $data['orderNumber'],
            saleKey: (string) $data['saleKey'],
            message: $data['message'] ?? null,
            id: (string) $data['id'],
            key: (string) $data['key'],
            number: (string) $data['number'],
            pointId: (int) $data['pointId'],
            comment: (string) $data['comment'],
            customer: CustomerResponse::fromArray($data['customer'] ?? []),
            datetime: new \DateTimeImmutable($data['datetime']),
            nomenclatures: $nomenclatures,
            delivery: DeliveryResponse::fromArray($data['delivery'] ?? []),
            paymentType: (int) $data['paymentType'],
            totalPrice: (float) ($data['totalPrice'] ?? 0.0),
            totalSum: (float) ($data['totalSum'] ?? 0.0),
            totalDiscount: isset($data['totalDiscount']) ? (float) $data['totalDiscount'] : null,
            promoCode: $promoCode,
            additionalFields: $additionalFields,
        );
    }
}
