<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Requests\Nomenclature;

use SabyApi\Domain\Dto\Requests\BaseRequest;
use Webmozart\Assert\Assert;

/**
 * Запрос списка прайс-листов и колонок цен
 */
final class PriceListsRequest extends BaseRequest
{
    /**
     * @param  int  $pointId  Идентификатор точки продаж
     * @param  string  $actualDate  Дата в формате YYYY-MM-DD
     * @param  string|null  $searchString  Фильтр по названию прайс-листа
     * @param  int|null  $page  Номер страницы
     * @param  int|null  $pageSize  Количество записей на странице (до 500)
     */
    public function __construct(
        public int $pointId,
        public string $actualDate,
        public ?string $searchString = null,
        public ?int $page = null,
        public ?int $pageSize = null
    ) {
        Assert::greaterThanEq($pointId, 1, 'pointId должен быть >= 1.');
        Assert::notEmpty($actualDate, 'actualDate не может быть пустым.');
        Assert::regex($actualDate, '/^\d{4}-\d{2}-\d{2}$/', 'actualDate должен быть в формате YYYY-MM-DD.');

        if ($pageSize !== null) {
            Assert::range($pageSize, 1, 500, 'pageSize должен быть в диапазоне 1–500.');
        }

    }
}
