<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Requests\Delivery;

use SabyApi\Domain\Dto\Requests\BaseRequest;
use Webmozart\Assert\Assert;

/**
 * Запрос для получения скорректированных адресов по введённой строке
 *
 * GET https://api.sbis.ru/retail/delivery/suggested-address
 *
 * @param  string  $enteredAddress  Адрес в произвольном виде (город, улица, дом)
 * @param  int|null  $pageSize  Количество записей на страницу
 */
final class SuggestedAddressRequest extends BaseRequest
{
    public function __construct(
        public string $enteredAddress,
        public ?int $pageSize = null,
    ) {
        Assert::notEmpty($enteredAddress, 'enteredAddress не может быть пустым.');
        if ($pageSize !== null) {
            Assert::greaterThanEq($pageSize, 1, 'pageSize должен быть >= 1.');
        }

    }

}
