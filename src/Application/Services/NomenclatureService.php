<?php

declare(strict_types=1);

namespace SabyApi\Application\Services;

use SabyApi\Constants;
use SabyApi\Domain\Dto\Requests\Nomenclature\CatalogRequest;
use SabyApi\Domain\Dto\Requests\Nomenclature\PriceListsRequest;
use SabyApi\Domain\Dto\Requests\Nomenclature\StopListRequest;
use SabyApi\Domain\Dto\Responses\Nomenclature\CatalogResponse;
use SabyApi\Domain\Dto\Responses\Nomenclature\ExtraMethodResponse;
use SabyApi\Domain\Dto\Responses\Nomenclature\PriceListsResponse;

final class NomenclatureService extends BaseService
{
    public function getPriceLists(PriceListsRequest $filter): PriceListsResponse
    {

        $response = $this->authorizedRequest(
            'GET',
            Constants::NOMECLATURE_PRICE_LIST,
            $filter->toArray(),
        );

        return PriceListsResponse::fromArray($response);

    }

    public function getProductList(CatalogRequest $filter): CatalogResponse
    {

        $response = $this->authorizedRequest(
            'GET',
            Constants::NOMECLATURE_PRODUCT_LIST,
            $filter->toArray(),
        );

        return CatalogResponse::fromArray($response);

    }

    public function getStopList(StopListRequest $filter): ExtraMethodResponse
    {

        $response = $this->authorizedRequest(
            'GET',
            Constants::NOMECLATURE_PRODUCT_LIST,
            $filter->toArray(),
        );

        return ExtraMethodResponse::fromArray($response);

    }
}
