<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Requests\Bonus;

use SabyApi\Domain\Dto\Requests\BaseRequest;
use Webmozart\Assert\Assert;

/**
 * Запрос на получение баланса бонусов клиента
 *
 * Метод: GET
 * URI:    /retail/customer/{externalId}/bonus-balance
 *
 * @param  string  $externalId  UUID клиента
 * @param  int  $pointId  Идентификатор точки продаж
 */
final class BonusBalanceRequest extends BaseRequest
{
    public function __construct(
        public string $externalId,
        public int $pointId,
    ) {
        Assert::uuid($externalId, 'externalId должен быть валидным UUID.');
        Assert::greaterThanEq($pointId, 1, 'pointId должен быть >= 1.');

    }
}
