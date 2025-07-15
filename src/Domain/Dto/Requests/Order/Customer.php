<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Requests\Order;

use SabyApi\Domain\Dto\Requests\BaseRequest;
use Webmozart\Assert\Assert;

final class Customer extends BaseRequest
{
    public function __construct(
        public ?string $externalId,
        public string $name,
        public ?string $lastname,
        public ?string $patronymic,
        public ?string $email,
        public string $phone,
    ) {
        Assert::notEmpty($name, 'Customer name is required');
        Assert::notEmpty($phone, 'Customer phone is required');
    }
}
