<?php

declare(strict_types = 1);

namespace Smolarium\Commissions\Infrastructure\Domain\Commission\Calculator\FactoryInterface;

use Smolarium\Commissions\Domain\Commission\Calculator;
use Smolarium\Commissions\Domain\Commission\Calculator\FactoryInterface;
use Smolarium\Commissions\Infrastructure\Domain\Country\RepositoryInterface\FakeImplementation as CountryRepository;
use Smolarium\Commissions\Infrastructure\Domain\CreditCard\RepositoryInterface\FakeImplementation as CreditCardRepository;
use Smolarium\Commissions\Infrastructure\Domain\Money\ExchangerInterface\FakeImplementation as MoneyExchanger;

class FakeImplementation implements FactoryInterface
{
    public function create() : Calculator
    {
        return new Calculator(
            new CreditCardRepository(),
            new CountryRepository(),
            new MoneyExchanger()
        );
    }
}
