<?php

declare(strict_types=1);

namespace SabyApi\Application\Services;

use SabyApi\Constants;
use SabyApi\Domain\Dto\Requests\Bonus\BonusBalanceRequest;
use SabyApi\Domain\Dto\Requests\Bonus\BonusWriteOffRequest;
use SabyApi\Domain\Dto\Responses\Bonus\BonusBalanceResponse;
use SabyApi\Domain\Dto\Responses\Bonus\BonusReadResponse;
use SabyApi\Domain\Dto\Responses\Bonus\BonusWriteOffResponse;

final class BonusService extends BaseService
{
    public function getBalance(BonusBalanceRequest $request): BonusBalanceResponse
    {

        $response = $this->authorizedRequest(
            'GET',
            Constants::GET_BONUS_BALANCE,
            $request->toArray(),
        );

        return BonusBalanceResponse::fromArray($response);

    }

    public function getReadBonus(string $externalID): BonusReadResponse
    {

        $response = $this->authorizedRequest(
            'GET',
            self::urlConstructor(Constants::GET_BONUS_BALANCE_WRITE_OFFS, $externalID),
            [],
        );

        return BonusReadResponse::fromArray($response);

    }

    public function writeOffBonus(BonusWriteOffRequest $request): BonusWriteOffResponse
    {

        $response = $this->authorizedRequest(
            'GET',
            self::urlConstructor(Constants::WRITE_OFF_CREDIT_BONUSES, $request->externalId),
            $request->toArray(),
        );

        return BonusWriteOffResponse::fromArray($response);

    }
}
