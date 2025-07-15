<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Requests\Nomenclature;

use SabyApi\Domain\Dto\Requests\BaseRequest;
use Webmozart\Assert\Assert;

final class StopListRequest extends BaseRequest
{
    /**
     * @param  int  $pointId  Идентификатор точки продаж
     * @param  int|null  $page  Номер страницы
     * @param  int|null  $pageSize  Количество записей на странице (до 500)
     */
    public function __construct(
        public int $pointId,
        public ?int $page = null,
        public ?int $pageSize = null
    ) {
        Assert::greaterThanEq($pointId, 1, 'pointId должен быть >= 1.');

        if ($pageSize !== null) {
            Assert::range($pageSize, 1, 500, 'pageSize должен быть в диапазоне 1–500.');
        }

    }
}
