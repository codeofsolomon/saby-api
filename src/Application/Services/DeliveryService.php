<?php

declare(strict_types=1);

namespace SabyApi\Application\Services;

use SabyApi\Constants;
use SabyApi\Domain\Dto\Requests\Delivery\DeliveryCostRequest;
use SabyApi\Domain\Dto\Requests\Delivery\SuggestedAddressRequest;
use SabyApi\Domain\Dto\Responses\Delivery\DeliveryCostResponse;
use SabyApi\Domain\Dto\Responses\Delivery\SuggestedAddressResponse;

final class DeliveryService extends BaseService
{
    public function getDeliveryCost(DeliveryCostRequest $request): DeliveryCostResponse
    {

        $response = $this->authorizedRequest(
            'GET',
            Constants::GET_DELIVERY_COST,
            $request->toArray(),
        );

        return DeliveryCostResponse::fromArray($response);

    }

    public function getSuggestedAddress(SuggestedAddressRequest $request): SuggestedAddressResponse
    {

        $response = $this->authorizedRequest(
            'GET',
            Constants::SUGGESTED_ADDRESS,
            $request->toArray(),
        );

        return SuggestedAddressResponse::fromArray($response);

    }
}
