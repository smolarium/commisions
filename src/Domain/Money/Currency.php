<?php

declare(strict_types = 1);

namespace Smolarium\Commissions\Domain\Money;

use JetBrains\PhpStorm\Pure;
use Smolarium\Commissions\Domain\Money\Currency\Code;

class Currency
{
    private Code $code;

    public function __construct(Code $code)
    {
        $this->code = $code;
    }

    public function getCode() : Code
    {
        return $this->code;
    }

    public function isSame(Currency $currency) : bool
    {
        return $this->code->getCode() === $currency->getCode()->getCode();
    }
}
