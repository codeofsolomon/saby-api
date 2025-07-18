<?php

declare(strict_types=1);

namespace SabyApi\Application\Services;

use SabyApi\Constants;

final class ClientService extends BaseService
{
    public function getBalance(string $phone_number): ?string
    {

        $response = $this->authorizedRequest(
            'GET',
            Constants::GET_CUSTOMER_ID.$phone_number,
            [],
        );

        return $response['person'];

    }
}
