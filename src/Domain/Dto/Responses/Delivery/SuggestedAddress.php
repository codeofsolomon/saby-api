<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Responses\Delivery;

/**
 * DTO одного скорректированного адреса
 *
 * @property string $addressFull Форматированный адрес (ФИАС)
 * @property string $addressJSON Адрес в формате JSON (для последующей передачи)
 */
final readonly class SuggestedAddress
{
    public function __construct(
        public string $addressFull,
        public string $addressJSON,
    ) {}

    /**
     * @param  array{addressFull: string, addressJSON: string}  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            addressFull: (string) ($data['addressFull'] ?? ''),
            addressJSON: (string) ($data['addressJSON'] ?? ''),
        );
    }
}
