<?php

declare(strict_types = 1);

namespace Smolarium\Commissions\Infrastructure\Domain\CreditCard\Factory;

use Smolarium\Commissions\Domain\Country\Code;
use Smolarium\Commissions\Domain\CreditCard;
use Smolarium\Commissions\Domain\CreditCard\Bin;

class ScalarImplementation
{
    public static function createFromScalar(
        int $binInt,
        string $countryCode
    ) : CreditCard {
        return new CreditCard(
            new Bin($binInt),
            new Code($countryCode)
        );
    }
}
