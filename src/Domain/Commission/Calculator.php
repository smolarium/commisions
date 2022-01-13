<?php

declare(strict_types = 1);

namespace Smolarium\Commissions\Domain\Commission;

use Smolarium\Commissions\Domain\Commision;
use Smolarium\Commissions\Domain\CreditCard\RepositoryInterface as CreditCardRepositoryInterface;
use Smolarium\Commissions\Domain\Money\Currency;
use Smolarium\Commissions\Domain\Money\Currency\Code as CurrencyCode;
use Smolarium\Commissions\Domain\Money\ExchangerInterface;
use Smolarium\Commissions\Domain\Payment;
use Smolarium\Commissions\Domain\Country\EuropeanUnionChecker;
use Smolarium\Commissions\Domain\Country\RepositoryInterface as CountryRepositoryInterface;
use Smolarium\Commissions\Domain\Country\Repository\NotFound as CountryNotFound;
use Smolarium\Commissions\Domain\CreditCard\Repository\NotFound as CreditCardNotFound;
use Smolarium\Commissions\Domain\Money\Exchanger\UnknownCourse as UnknownCourse;

class Calculator
{
    private CreditCardRepositoryInterface $creditCardRepository;
    private CountryRepositoryInterface $countryRepository;
    private ExchangerInterface $moneyExchanger;
    private const chargeForEuropeanUnion = 0.1;
    private const chargeForNotEuropeanUnion = 0.2;

    public function __construct(
        CreditCardRepositoryInterface $creditCardRepository,
        CountryRepositoryInterface $countryRepository,
        ExchangerInterface $moneyExchanger
    ) {
        $this->creditCardRepository = $creditCardRepository;
        $this->countryRepository = $countryRepository;
        $this->moneyExchanger = $moneyExchanger;
    }

    /**
     * @param Payment $payment
     * @return Commision
     * @throws CountryNotFound
     * @throws CreditCardNotFound
     * @throws UnknownCourse
     */
    public function calculate(Payment $payment) : Commision
    {
        $bin = $payment->getBin();
        $creditCard = $this->creditCardRepository->getByBin($bin);
        $countryCode = $creditCard->getCountryCode();
        $country = $this->countryRepository->getByCode($countryCode);
        $euro = new Currency(new CurrencyCode('EUR'));
        $moneyInEuro = $this->moneyExchanger->exchange($payment->getMoney(), $euro);
        $charge = (
            EuropeanUnionChecker::isFromEuropeanUnion($country)
            ? $this::chargeForEuropeanUnion
            : $this::chargeForNotEuropeanUnion
        );
        return new Commision($moneyInEuro->multiply($charge));
    }
}
