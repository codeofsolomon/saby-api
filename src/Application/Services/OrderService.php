<?php

declare(strict_types=1);

namespace SabyApi\Application\Services;

use SabyApi\Constants;
use SabyApi\Domain\Dto\Requests\Order\CreateOrderRequest;
use SabyApi\Domain\Dto\Requests\Order\CreatePaymentRequest;
use SabyApi\Domain\Dto\Responses\Order\CreateOrderResponse;

final class OrderService extends BaseService
{
    public static function urlConstructor(string $uri, string $externalId): string
    {
        // можно и strtr, и str_replace — по вкусу
        return str_replace('{externalId}', $externalId, $uri);
    }

    public function createOrder(CreateOrderRequest $request): CreateOrderResponse
    {

        $response = $this->authorizedRequest(
            'POST',
            Constants::CREATE_ORDER,
            $request->toArray(),
        );

        return CreateOrderResponse::fromArray($response);

    }

    public function cancelOrder(string $externalID): CreateOrderResponse
    {
        $response = $this->authorizedRequest(
            'PUT',
            self::urlConstructor(Constants::CANCEL_ORDER, $externalID),
            [],
        );

        return CreateOrderResponse::fromArray($response);
    }

    public function getOrderInfo(string $externalID): CreateOrderResponse
    {
        $response = $this->authorizedRequest(
            'GET',
            self::urlConstructor(Constants::GET_ORDER_INFO, $externalID),
            [],
        );

        return CreateOrderResponse::fromArray($response);
    }

    public function getOrderStatus(string $externalID): CreateOrderResponse
    {
        $response = $this->authorizedRequest(
            'GET',
            self::urlConstructor(Constants::GET_ORDER_STATUS, $externalID),
            [],
        );

        return CreateOrderResponse::fromArray($response);
    }

    public function createPaymentLink(CreatePaymentRequest $request, string $externalID): string
    {
        $response = $this->authorizedRequest(
            'GET',
            self::urlConstructor(Constants::GET_PAYMENT_LINK, $externalID),
            $request->toArray(),
        );

        return $response['link'];
    }
}
