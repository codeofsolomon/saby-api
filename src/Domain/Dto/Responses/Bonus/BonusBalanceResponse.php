<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Responses\Bonus;

/**
 * Ответ API: баланс бонусов клиента в точке продаж
 *
 * @property float|null $bonusBalance Баланс бонусов или null, если оплата бонусами отключена
 */
final readonly class BonusBalanceResponse
{
    public function __construct(
        public ?float $bonusBalance,
    ) {}

    /**
     * Гидратор из массива ответа
     *
     * @param  array{bonusBalance: float|null}  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            bonusBalance: isset($data['bonusBalance'])
                ? (float) $data['bonusBalance']
                : null
        );
    }
}
