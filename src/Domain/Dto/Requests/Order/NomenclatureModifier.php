<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Requests\Order;

use SabyApi\Domain\Dto\Requests\BaseRequest;
use Webmozart\Assert\Assert;

final class NomenclatureModifier extends BaseRequest
{
    public function __construct(
        public int $id,
        public int $hierarchicalId,
        public int $count,
        public ?float $cost,
        public ?string $name,
    ) {
        Assert::greaterThanEq($id, 1, 'Modifier id is required');
        Assert::greaterThanEq($hierarchicalId, 0, 'Modifier hierarchicalId is required');
        Assert::greaterThanEq($count, 1, 'Modifier count must be at least 1');
    }
}
