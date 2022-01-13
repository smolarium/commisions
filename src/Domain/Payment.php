<?php

declare(strict_types = 1);

namespace Smolarium\Commissions\Domain;

use Smolarium\Commissions\Domain\CreditCard\Bin;

class Payment
{
    private Bin $bin;
    private Money $money;

    public function __construct(Bin $bin, Money $money)
    {
        $this->bin = $bin;
        $this->money = $money;
    }

    public function getBin() : Bin
    {
        return $this->bin;
    }

    public function getMoney() : Money
    {
        return $this->money;
    }
}
