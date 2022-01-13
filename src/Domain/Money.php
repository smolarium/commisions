<?php

declare(strict_types=1);

namespace Smolarium\Commissions\Domain;

use JetBrains\PhpStorm\Pure;
use Smolarium\Commissions\Domain\Money\Currency;

class Money
{
    private int $amount;
    private Currency $currency;

    public function __construct(int $amount, Currency $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function getAmount() : int
    {
        return $this->amount;
    }

    public function getCurrency() : Currency
    {
        return $this->currency;
    }

    public function multiply(float $multiplier) : self
    {
        $newAmount = (int)ceil($this->amount * $multiplier); // This is simplified requirement 2
        return new Money(
            $newAmount,
            $this->currency
        );
    }
}
