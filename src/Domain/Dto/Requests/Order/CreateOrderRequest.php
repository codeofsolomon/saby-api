<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Requests\Order;

use SabyApi\Domain\Dto\Requests\BaseRequest;
use Webmozart\Assert\Assert;

final class CreateOrderRequest extends BaseRequest
{
    /** @param Nomenclature[] $nomenclatures */
    public function __construct(
        public string $product,
        public int $pointId,
        public Customer $customer,
        public string $datetime, // гггг-мм-дд чч:мм:сс
        public array $nomenclatures,
        public Delivery $delivery,
        public ?string $comment = null,
        public ?string $promocode = null,
        public ?string $promocodeV2 = null,
    ) {
        Assert::greaterThanEq($pointId, 1, 'pointId must be >= 1');
        Assert::notEmpty($datetime, 'datetime is required');

    }
}
