<?php

declare(strict_types = 1);

namespace Smolarium\Commissions\Domain;

class Commision
{
    private Money $money;

    public function __construct(Money $money)
    {
        $this->money = $money;
    }

    public function getMoney() : Money
    {
        return $this->money;
    }
}
