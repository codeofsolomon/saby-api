<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Responses\Nomenclature;

/**
 * Ответ API: список товаров каталога
 *
 * @property CatalogItem[] $nomenclatures
 */
final readonly class CatalogResponse
{
    public function __construct(
        public array $nomenclatures,
        public bool $hasMore,
    ) {}

    public static function fromArray(array $data): self
    {
        $hasMore = isset($data['outcome']['hasMore'])
             ? (bool) $data['outcome']['hasMore']
             : false;

        return new self(
            nomenclatures: array_map(CatalogItem::class.'::fromArray', $data['nomenclatures'] ?? []),
            hasMore: $hasMore,
        );
    }
}
