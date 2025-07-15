<?php

declare(strict_types=1);

namespace SabyApi\Application\Contracts\Auth;

interface AuthenticatorInterface
{
    /**
     * Возвращает валидный bearer-токен.
     */
    public function token(): string;
}
