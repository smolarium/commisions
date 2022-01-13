<?php

declare(strict_types = 1);

namespace Smolarium\Commissions\Infrastructure\Domain\Money\Factory;

use Smolarium\Commissions\Domain\Money;
use Smolarium\Commissions\Domain\Money\Currency;
use Smolarium\Commissions\Domain\Money\Currency\Code as CurrencyCode;

class ScalarImplementation
{
    public static function createFromScalar(
        float $amount,
        string $currencyCode
    ) : Money {
        return new Money(
            (int)ceil($amount * 100), // In cents
            new Currency(
                new CurrencyCode($currencyCode)
            )
        );
    }
}
