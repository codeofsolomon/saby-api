<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Requests\Order;

use SabyApi\Domain\Dto\Requests\BaseRequest;
use Webmozart\Assert\Assert;

final class Nomenclature extends BaseRequest
{
    /** @param NomenclatureModifier[] $modifiers */
    public function __construct(
        public ?string $externalId,
        public ?int $id,
        public ?string $nomNumber,
        public float $count,
        public ?float $cost,
        public ?string $name,
        public ?int $priceListId,
        public ?int $hierarchicalId,
        public array $serialNumbers,
        public array $modifiers,
    ) {
        Assert::greaterThanEq($count, 0.01, 'Nomenclature count must be > 0');
    }

}
