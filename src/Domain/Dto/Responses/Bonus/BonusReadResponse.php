<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Responses\Bonus;

/**
 * Ответ: суммы бонусов для списания и начисления в заказе
 *
 * @property float|null $availableBonusBalance Доступный баланс бонусов
 * @property float|null $totalBonusBalance Общий баланс бонусов
 * @property float|null $availableBonusDec Сумма, доступная к списанию
 * @property float|null $userBonusDec Сумма, применённая к продаже
 * @property float|null $availableBonusInc Сумма бонусов для начисления
 * @property int|null $bonusAction Действие с бонусами (1 – начисление, -1 – списание)
 * @property float|null $bonusDec Бонусы, списанные в результате продажи
 * @property float|null $bonusInc Бонусы, начисленные в результате продажи
 * @property \DateTimeImmutable|null $bonusIncDateTime Время отложенного начисления
 * @property string|null $bonusBalanceError Ошибка при определении баланса
 * @property int|null $cardId Идентификатор карты
 * @property int|null $personalCardId Идентификатор персональной карты
 * @property bool|null $hasIncForbiddenNoms Есть товары без начисления
 * @property bool|null $hasDecForbiddenNoms Есть товары без списания
 */
final readonly class BonusReadResponse
{
    public function __construct(
        public ?float $availableBonusBalance,
        public ?float $totalBonusBalance,
        public ?float $availableBonusDec,
        public ?float $userBonusDec,
        public ?float $availableBonusInc,
        public ?int $bonusAction,
        public ?float $bonusDec,
        public ?float $bonusInc,
        public ?\DateTimeImmutable $bonusIncDateTime,
        public ?string $bonusBalanceError,
        public ?int $cardId,
        public ?int $personalCardId,
        public ?bool $hasIncForbiddenNoms,
        public ?bool $hasDecForbiddenNoms
    ) {}

    /**
     * Гидратор из массива ответа
     *
     * @param array{
     *   availableBonusBalance?: string|float,
     *   totalBonusBalance?: string|float,
     *   availableBonusDec?: string|float,
     *   userBonusDec?: string|float,
     *   availableBonusInc?: string|float,
     *   bonusAction?: int,
     *   bonusDec?: string|float,
     *   bonusInc?: string|float,
     *   bonusIncDateTime?: string,
     *   bonusBalanceError?: string,
     *   cardId?: int,
     *   personalCardId?: int,
     *   hasIncForbiddenNoms?: bool,
     *   hasDecForbiddenNoms?: bool
     * } $data
     */
    public static function fromArray(array $data): self
    {
        $incDate = null;
        if (! empty($data['bonusIncDateTime'])) {
            $incDate = new \DateTimeImmutable($data['bonusIncDateTime']);
        }

        return new self(
            availableBonusBalance: isset($data['availableBonusBalance']) ? (float) $data['availableBonusBalance'] : null,
            totalBonusBalance: isset($data['totalBonusBalance']) ? (float) $data['totalBonusBalance'] : null,
            availableBonusDec: isset($data['availableBonusDec']) ? (float) $data['availableBonusDec'] : null,
            userBonusDec: isset($data['userBonusDec']) ? (float) $data['userBonusDec'] : null,
            availableBonusInc: isset($data['availableBonusInc']) ? (float) $data['availableBonusInc'] : null,
            bonusAction: $data['bonusAction'] ?? null,
            bonusDec: isset($data['bonusDec']) ? (float) $data['bonusDec'] : null,
            bonusInc: isset($data['bonusInc']) ? (float) $data['bonusInc'] : null,
            bonusIncDateTime: $incDate,
            bonusBalanceError: $data['bonusBalanceError'] ?? null,
            cardId: $data['cardId'] ?? null,
            personalCardId: $data['personalCardId'] ?? null,
            hasIncForbiddenNoms: $data['hasIncForbiddenNoms'] ?? null,
            hasDecForbiddenNoms: $data['hasDecForbiddenNoms'] ?? null
        );
    }
}
