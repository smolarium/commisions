<?php

declare(strict_types = 1);

namespace Smolarium\Commissions\Domain;

use Smolarium\Commissions\Domain\CreditCard\Bin;
use Smolarium\Commissions\Domain\Country\Code;

class CreditCard
{
    private Bin $bin;
    private Code $countryCode;

    public function __construct(Bin $bin, Code $countryCode)
    {
        $this->bin = $bin;
        $this->countryCode = $countryCode;
    }

    public function getBin() : Bin
    {
        return $this->bin;
    }

    public function getCountryCode() : Code
    {
        return $this->countryCode;
    }
}
