<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Responses\Nomenclature;

/**
 * DTO модификатора товара
 */
final readonly class Modifier
{
    public function __construct(
        public int $id,
        public string $name,
        public float $cost,
        public int $baseCount,
        public float $count,
        public float $maxCount,
        public float $minCount,
        public int $parentType,
        public int $hierarchicalParent,
        public int $hierarchicalId,
        public bool $isParent,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: (int) ($data['id'] ?? 0),
            name: (string) ($data['name'] ?? ''),
            cost: (float) ($data['cost'] ?? 0.0),
            baseCount: (int) ($data['baseCount'] ?? 0),
            count: (float) ($data['count'] ?? 0.0),
            maxCount: (float) ($data['maxCount'] ?? 0.0),
            minCount: (float) ($data['minCount'] ?? 0.0),
            parentType: (int) ($data['parentType'] ?? 0),
            hierarchicalParent: (int) ($data['hierarchicalParent'] ?? 0),
            hierarchicalId: (int) ($data['hierarchicalId'] ?? 0),
            isParent: (bool) ($data['isParent'] ?? false),
        );
    }
}
