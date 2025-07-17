<?php

declare(strict_types=1);

namespace SabyApi\Application\Services;

use SabyApi\Constants;
use SabyApi\Domain\Dto\Requests\Order\CreateOrderRequest;
use SabyApi\Domain\Dto\Requests\Order\CreatePaymentRequest;
use SabyApi\Domain\Dto\Responses\Order\CreateOrderResponse;
use SabyApi\Domain\Dto\Responses\Order\OrderStatusResponse;
use SabyApi\Domain\Dto\Responses\Order\OrderDetailsResponse;

final class OrderService extends BaseService
{
    public function createOrder(CreateOrderRequest $request): CreateOrderResponse
    {

        $response = $this->authorizedRequest(
            'POST',
            Constants::CREATE_ORDER,
            $request->toArray(),
        );

        return CreateOrderResponse::fromArray($response);

    }

    public function cancelOrder(string $externalID): bool
    {
        $response = $this->authorizedRequest(
            'PUT',
            self::urlConstructor(Constants::CANCEL_ORDER, $externalID),
            [],
        );

        return $response['success'];
    }

    public function getOrderInfo(string $externalID): OrderDetailsResponse
    {
        $response = $this->authorizedRequest(
            'GET',
            self::urlConstructor(Constants::GET_ORDER_INFO, $externalID),
            [],
        );

        return OrderDetailsResponse::fromArray($response);
    }

    public function getOrderStatus(string $externalID): OrderStatusResponse
    {
        $response = $this->authorizedRequest(
            'GET',
            self::urlConstructor(Constants::GET_ORDER_STATUS, $externalID),
            [],
        );

        return OrderStatusResponse::fromArray($response);
    }

    public function createPaymentLink(CreatePaymentRequest $request): string
    {
        $response = $this->authorizedRequest(
            'GET',
            self::urlConstructor(Constants::GET_PAYMENT_LINK, $request->externalId),
            $request->toArray(),
        );

        return $response['link'];
    }
}
