<?php

declare(strict_types=1);

namespace SabyApi\Application\Services;

use SabyApi\Constants;
use SabyApi\Domain\Dto\Requests\SalesPoint\SalesPointsRequest;
use SabyApi\Domain\Dto\Responses\SalesPoint\SalesPointsResponse;

final class SalePointService extends BaseService
{
    public function getSalePoints(?SalesPointsRequest $filter): SalesPointsResponse
    {
        $filter ??= new SalesPointsRequest;

        $response = $this->authorizedRequest(
            'GET',
            Constants::SALE_POINTS,
            $filter->toArray(),
        );

        return SalesPointsResponse::fromArray($response);

    }
}
