<?php

declare(strict_types = 1);

namespace Smolarium\Commissions\Infrastructure\Domain\Payment\Factory;

use Smolarium\Commissions\Domain\CreditCard\Bin;
use Smolarium\Commissions\Domain\Payment;
use Smolarium\Commissions\Infrastructure\Domain\Money\Factory\ScalarImplementation as MoneyFactory;

class ScalarImplementation
{
    public static function createFromScalar(
        int $bin,
        float $amount,
        string $currencyCode
    ) : Payment {
        return new Payment(
            new Bin($bin),
            MoneyFactory::createFromScalar($amount, $currencyCode)
        );
    }
}
