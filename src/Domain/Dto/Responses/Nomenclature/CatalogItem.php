<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Responses\Nomenclature;

/**
 * DTO товара каталога
 */
final readonly class CatalogItem
{
    /** @var Barcode[] */
    public array $barcodes;

    /** @var Modifier[] */
    public array $modifiers;

    /** @var string[] URL изображений */
    public ?array $images;

    /** @var float[] */
    public ?array $priceIntervals;

    public function __construct(
        public ?string $article,

        public ?string $balance,
        array $barcodes,
        public float $cost,
        public string $description,
        public ?string $externalId,
        public ?int $hierarchicalId,
        public ?int $hierarchicalParent,
        public int $id,
        ?array $images,
        public ?string $name,
        public ?int $indexNumber,
        array $modifiers,
        public ?string $nomNumber,

        public ?bool $published,
        public ?int $shortCode,
        public ?string $unit,
        public ?bool $outcome,
        ?array $priceIntervals,
    ) {

        $this->barcodes = $barcodes;
        $this->modifiers = $modifiers;
        $this->images = $images;
        $this->priceIntervals = $priceIntervals;
    }

    public static function fromArray(array $data): self
    {
        $barcodes = array_map(
            static fn (array $b) => Barcode::fromArray($b),
            $data['barcodes'] ?? []
        );

        $modifiers = array_map(
            static fn (array $m) => Modifier::fromArray($m),
            $data['modifiers'] ?? []
        );

        $images = [];
        if ($data['images']) {
            foreach ($data['images'] as $item) {
                $images[] = 'https://api.sbis.ru/retail'.$item;
            }
        }

        return new self(
            article: (string) ($data['article'] ?? ''),

            balance: $data['balance'] ?? null,
            barcodes: $barcodes,
            cost: (float) ($data['cost'] ?? 0.0),
            description: (string) ($data['description'] ?? ''),
            externalId: (string) ($data['externalId'] ?? ''),
            hierarchicalId: (int) ($data['hierarchicalId'] ?? 0),
            hierarchicalParent: (int) ($data['hierarchicalParent'] ?? 0),
            id: (int) ($data['id'] ?? 0),
            images: $images,
            name: $data['name'],
            indexNumber: (int) ($data['indexNumber'] ?? 0),
            modifiers: $modifiers,
            nomNumber: $data['nomNumber'],
            published: (bool) ($data['published'] ?? false),
            shortCode: (int) ($data['short_code'] ?? 0),
            unit: (string) ($data['unit'] ?? ''),
            outcome: (bool) ($data['outcome'] ?? false),
            priceIntervals: $data['priceIntervals'] ?? [],
        );
    }
}
