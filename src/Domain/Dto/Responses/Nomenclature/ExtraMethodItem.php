<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Responses\Nomenclature;

final readonly class ExtraMethodItem
{
    /** @var string[] URL изображений */
    public ?array $images;

    public function __construct(

        public ?int $balance,
        public ?float $count,
        public ?string $externalId,
        public int $id,
        ?array $images,
        public ?string $name,
        public ?string $nomNumber,
        public ?float $period,
        public ?string $reason,
        public ?int $stopListId,

    ) {

        $this->images = $images;

    }

    public static function fromArray(array $data): self
    {

        $images = [];
        if ($data['images']) {
            foreach ($data['images'] as $item) {
                $images[] = 'https://api.sbis.ru/retail'.$item;
            }
        }

        return new self(

            balance: $data['balance'] ?? null,

            count: (float) ($data['count'] ?? 0.0),

            externalId: (string) ($data['externalId'] ?? ''),
            period: (float) ($data['period'] ?? 0),

            id: (int) ($data['id'] ?? 0),
            images: $images,
            name: $data['name'],

            nomNumber: $data['nomNumber'],

            stopListId: (int) ($data['short_code'] ?? 0),
            reason: (string) ($data['reason'] ?? ''),

        );
    }
}
