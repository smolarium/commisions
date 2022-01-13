<?php

declare(strict_types = 1);

namespace Smolarium\Commissions\Domain\Money;

use Smolarium\Commissions\Domain\Money;
use Smolarium\Commissions\Domain\Money\Exchanger\UnknownCourse;

interface ExchangerInterface
{
    /**
     * @param Money $money
     * @param Currency $exchangeTo
     * @return Money
     * @throws UnknownCourse
     */
    public function exchange(Money $money, Currency $exchangeTo) : Money;
}
