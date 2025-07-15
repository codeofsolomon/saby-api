<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Responses\Nomenclature;

/**
 * DTO штрих-кода товара
 */
final readonly class Barcode
{
    public function __construct(
        public string $code,
        public string $codeType,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            code: (string) $data['code'],
            codeType: (string) $data['codeType'],
        );
    }
}
