<?php

declare(strict_types = 1);

namespace Smolarium\Commissions\Domain;

use Smolarium\Commissions\Domain\Country\Code;

class Country
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
}
