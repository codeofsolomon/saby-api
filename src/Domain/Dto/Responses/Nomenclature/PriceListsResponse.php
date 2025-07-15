<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Responses\Nomenclature;

/**
 * Ответ API: список прайс-листов и колонок цен
 *
 * @property PriceList[] $priceLists
 * @property bool $hasMore
 */
final readonly class PriceListsResponse
{
    /**
     * @param  PriceList[]  $priceLists
     */
    public function __construct(
        public array $priceLists,
        public bool $hasMore,
    ) {}

    public static function fromArray(array $data): self
    {

        $hasMore = isset($data['outcome']['hasMore'])
            ? (bool) $data['outcome']['hasMore']
            : false;

        return new self(
            priceLists: array_map(PriceList::class.'::fromArray', $data['priceLists'] ?? []),
            hasMore: $hasMore,
        );
    }
}
