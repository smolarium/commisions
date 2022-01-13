<?php

declare(strict_types = 1);

namespace Smolarium\Commissions\Infrastructure\Domain\Money\ExchangerInterface;

use Smolarium\Commissions\Domain\Money;
use Smolarium\Commissions\Domain\Money\Exchanger\UnknownCourse;
use Smolarium\Commissions\Domain\Money\Currency;
use Smolarium\Commissions\Domain\Money\ExchangerInterface;

class FakeImplementation implements ExchangerInterface
{
    private const knownCourses = [
        'EUR' => ['EUR' => 1],
        'GBP' => ['EUR' => 1.236787292],
        'DKK' => ['EUR' => 0.1340623154301627],
        'JPY' => ['EUR' => 0.009672961645436389],
        'USD' => ['EUR' => 0.7720673883225837],
    ];

    public function exchange(Money $money, Currency $exchangeTo) : Money
    {
        if ($money->getCurrency()->isSame($exchangeTo)) {
            return $money; //There is no need to calculate anything
        }

        $fromString = $money->getCurrency()->getCode()->getCode();
        $toString = $exchangeTo->getCode()->getCode();
        if (
            !array_key_exists($fromString, $this::knownCourses)
            || !array_key_exists($toString, $this::knownCourses[$fromString])
        ) {
            throw new UnknownCourse();
        }

        $courseRate = $this::knownCourses[$fromString][$toString];
        $amountInCents = $money->getAmount();
        $newMoney = new Money($amountInCents, $exchangeTo); //Here is just changing the currency. Amount stayed the same.
        return $newMoney->multiply($courseRate); //Here amount is actually changed
    }
}
