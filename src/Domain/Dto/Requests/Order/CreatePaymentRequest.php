<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Requests\Order;

use SabyApi\Domain\Dto\Requests\BaseRequest;
use Webmozart\Assert\Assert;

final class CreatePaymentRequest extends BaseRequest
{
    public function __construct(
        public string $externalId,
        public string $shopURL,
        public ?string $successURL,
        public ?string $errorURL,
    ) {

        Assert::notEmpty($externalId, 'externalId is required');
        Assert::notEmpty($shopURL, 'shopURL is required');

    }
}
