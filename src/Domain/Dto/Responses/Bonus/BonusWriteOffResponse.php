<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Responses\Bonus;

/**
 * Ответ API: итоговые суммы после списания/начисления бонусов
 *
 * @property float $totalPrice Итоговая сумма продажи
 * @property float $totalDiscount Общая сумма скидок
 */
final readonly class BonusWriteOffResponse
{
    public function __construct(
        public float $totalPrice,
        public float $totalDiscount
    ) {}

    /**
     * Гидратор из массива ответа
     *
     * @param  array{totalPrice: float|string, totalDiscount: float|string}  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            totalPrice: (float) ($data['totalPrice'] ?? 0.0),
            totalDiscount: (float) ($data['totalDiscount'] ?? 0.0),
        );
    }
}
