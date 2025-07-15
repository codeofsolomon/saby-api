<?php

namespace SabyApi\Domain\Enums;

use JsonSerializable;

enum OrderStatus: int implements JsonSerializable
{
    case New = 10;
    case Accepted = 21;
    case Processing = 70;

    case Assembly = 81;

    case Delivery = 90;

    case ReadyForPickup = 91;

    case Closed = 200;

    case Canceled = 220;

    public function jsonSerialize(): mixed
    {
        return $this->value;
    }
}
