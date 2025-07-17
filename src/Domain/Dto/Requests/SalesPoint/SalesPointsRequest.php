<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Requests\SalesPoint;

use SabyApi\Domain\Dto\Requests\BaseRequest;
use Webmozart\Assert\Assert;

/**
 * Запрос списка точек продаж по API Saby Retail
 *
 * @param  int  $pointId  Идентификатор точки продаж (обязательно)
 * @param  string  $product  Название продукта Saby (обязательно)
 * @param  bool  $withPhones  Флаг передачи всех телефонов (по умолчанию false)
 * @param  bool  $withPrices  Флаг передачи идентификаторов прайсов (по умолчанию false)
 * @param  bool  $withSchedule  Флаг передачи подробного режима работы (по умолчанию false)
 * @param  int|null  $page  Номер страницы
 * @param  int|null  $pageSize  Размер страницы (0–500)
 */
final class SalesPointsRequest extends BaseRequest
{
    public function __construct(
        public ?int $pointId = null,
        public ?string $product = null,
        public bool $withPhones = true,
        public bool $withPrices = true,
        public bool $withSchedule = true,
        public ?int $page = null,
        public ?int $pageSize = null,
    ) {

        if ($page !== null) {
            Assert::greaterThanEq($page, 1, 'page должен быть ≥ 1.');
        }
        if ($pageSize !== null) {
            Assert::range($pageSize, 0, 500, 'pageSize должен быть в диапазоне 0–500.');
        }
    }
}
