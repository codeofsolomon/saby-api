<?php

namespace SabyApi\Domain\Enums;

use JsonSerializable;

enum PaymentType: string implements JsonSerializable
{
    case Card = 'card';
    case Online = 'online';
    case Cash = 'cash';

    public function jsonSerialize(): mixed
    {
        return $this->value;
    }
}
