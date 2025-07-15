<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Requests\Nomenclature;

use SabyApi\Domain\Dto\Requests\BaseRequest;
use Webmozart\Assert\Assert;

/**
 * Запрос получения списка товаров (каталога) для Saby Retail
 *
 * Параметры запроса:
 * - pointId (int): Идентификатор точки продаж
 * - priceListId (?int): Идентификатор прайс-листа (опционально)
 * - noStopList (bool): Исключить стоп-листовые позиции
 * - withBalance (bool): Передавать остатки
 * - withBarcode (bool): Передавать штрихкоды
 * - searchString (?string): Фильтрация по названию
 * - page (?int): Номер страницы
 * - pageSize (?int): Размер страницы
 * - product (string): Сервис ("delivery")
 */
final class CatalogRequest extends BaseRequest
{
    public function __construct(
        public int $pointId,
        public ?int $priceListId = null,
        public bool $noStopList = false,
        public bool $withBalance = true,
        public bool $withBarcode = true,
        public ?string $searchString = null,
        public ?int $page = null,
        public ?int $pageSize = null,
        public string $product = 'delivery',
    ) {
        Assert::greaterThanEq($pointId, 1, 'pointId должен быть ≥ 1.');
        if ($priceListId !== null) {
            Assert::greaterThanEq($priceListId, 1, 'priceListId должен быть ≥ 1.');
        }

        if ($pageSize !== null) {
            Assert::range($pageSize, 1, 500, 'pageSize должен быть в диапазоне 1–500.');
        }

    }

}
