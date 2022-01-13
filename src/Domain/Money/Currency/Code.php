<?php

declare(strict_types = 1);

namespace Smolarium\Commissions\Domain\Money\Currency;

class Code
{
    private string $code;

    public function __construct(string $code)
    {
        $this->code = $code;
    }

    public function getCode(): string
    {
        return $this->code;
    }
}
