<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Requests\Delivery;

use SabyApi\Domain\Dto\Requests\BaseRequest;
use Webmozart\Assert\Assert;

final class DeliveryCostRequest extends BaseRequest
{
    public function __construct(
        public int $pointId,
        public string $address,
    ) {

        Assert::notEmpty($pointId, 'pointId не может быть пустым.');
        Assert::notEmpty($address, 'address не может быть пустым.');

    }
}
