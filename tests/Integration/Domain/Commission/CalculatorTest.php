<?php

declare(strict_types = 1);

namespace Smolarium\Commissions\Tests\Unit\Domain\Commission;

use PHPUnit\Framework\TestCase;
use Smolarium\Commissions\Domain\Commission\Calculator;
use Smolarium\Commissions\Domain\CreditCard\Repository\NotFound as CreditCardNotFound;
use Smolarium\Commissions\Domain\Country\Repository\NotFound as CountryNotFound;
use Smolarium\Commissions\Domain\CreditCard\RepositoryInterface;
use Smolarium\Commissions\Domain\Money\Exchanger\UnknownCourse;
use Smolarium\Commissions\Infrastructure\Domain\Commission\Calculator\FactoryInterface\FakeImplementation as CalculatorFactory;
use Smolarium\Commissions\Infrastructure\Domain\Country\RepositoryInterface\FakeImplementation as CountryRepository;
use Smolarium\Commissions\Infrastructure\Domain\CreditCard\Factory\ScalarImplementation;
use Smolarium\Commissions\Infrastructure\Domain\Money\ExchangerInterface\FakeImplementation as MoneyExchanger;
use Smolarium\Commissions\Infrastructure\Domain\Money\Factory\ScalarImplementation as MoneyFactory;
use Smolarium\Commissions\Infrastructure\Domain\Payment\Factory\ScalarImplementation as PaymentFactory;

class CalculatorTest extends TestCase
{
    public function testCalculator_GivenValidPayment_ReturnProperCommission() : void
    {
        //Arrange
        $calculator = $this->getFakeCalculator();
        $payment = PaymentFactory::createFromScalar(45717360, 123.00, 'EUR');
        $expectedMoney = MoneyFactory::createFromScalar(12.30, 'EUR');

        //Act
        $commission = $calculator->calculate($payment);
        $actualMoney = $commission->getMoney();

        //Assert
        $this->assertEquals($expectedMoney, $actualMoney);
    }

    public function testCalculator_GivenInvalidBin_ThrowsException() : void
    {
        //Arrange
        $calculator = $this->getFakeCalculator();
        $payment = PaymentFactory::createFromScalar(999, 123.00, 'EUR');

        //Assert
        $this->expectException(CreditCardNotFound::class);

        //Act
        $calculator->calculate($payment);
    }

    public function testCalculator_GivenUnknownCurrency_ThrowsCourseException() : void
    {
        //Arrange
        $calculator = $this->getFakeCalculator();
        $payment = PaymentFactory::createFromScalar(45717360, 123.00, 'XXX');

        //Assert
        $this->expectException(UnknownCourse::class);

        //Act
        $calculator->calculate($payment);
    }

    public function testCalculator_GivenInvalidCountry_ThrowsException() : void
    {
        //Arrange
        $creditCardRepositoryMock = $this->createMock(RepositoryInterface::class);
        $creditCardRepositoryMock
            ->method('getByBin')
            ->willReturn(ScalarImplementation::createFromScalar(123, 'XXX'))
        ;
        $calculator = new Calculator(
            $creditCardRepositoryMock,
            new CountryRepository(),
            new MoneyExchanger()
        );
        $payment = PaymentFactory::createFromScalar(45717360, 123.00, 'EUR');

        //Assert
        $this->expectException(CountryNotFound::class);

        //Act
        $calculator->calculate($payment);
    }

    private function getFakeCalculator() : Calculator
    {
        $calculatorFactory = new CalculatorFactory();
        return $calculatorFactory->create();
    }
}
