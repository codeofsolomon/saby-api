<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Requests\Order;

use SabyApi\Domain\Dto\Requests\BaseRequest;
use SabyApi\Domain\Enums\PaymentType;
use Webmozart\Assert\Assert;

final class Delivery extends BaseRequest
{
    public function __construct(
        public ?string $addressJSON,
        public ?string $addressFull,
        public ?int $persons,
        public ?int $district,
        public ?float $changeAmount,
        public PaymentType $paymentType,
        public ?string $shopURL,
        public ?string $successURL,
        public ?string $errorURL,
        public bool $isPickup,
    ) {
        Assert::notEmpty($paymentType, 'paymentType is required');
    }
}
