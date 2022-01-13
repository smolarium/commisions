<?php

declare(strict_types = 1);

namespace Smolarium\Commissions\Domain\CreditCard;

class Bin
{
    private int $bin;

    public function __construct(int $bin)
    {
        $this->bin = $bin;
    }

    public function getBin() : int
    {
        return $this->bin;
    }
}
