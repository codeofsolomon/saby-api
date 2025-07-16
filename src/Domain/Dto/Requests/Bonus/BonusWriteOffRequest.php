<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Requests\Bonus;

use SabyApi\Domain\Dto\Requests\BaseRequest;
use Webmozart\Assert\Assert;

final class BonusWriteOffRequest extends BaseRequest
{
    public function __construct(
        public string $externalId,
        public ?int $bonusDec
    ) {
        Assert::uuid($externalId, 'externalId должен быть валидным UUID заказа.');
        if ($bonusDec !== null) {
            Assert::greaterThanEq($bonusDec, 0, 'bonusDec должен быть ≥ 0.');
        }

    }
}
