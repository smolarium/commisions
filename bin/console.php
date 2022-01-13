<?php

declare(strict_types = 1);

require(__DIR__ . '/../vendor/autoload.php');

use Symfony\Component\Console\Application;
use Smolarium\Commissions\Infrastructure\Console\Command\ProcessInputFile;
use Smolarium\Commissions\Domain\Commission\Calculator;
use Smolarium\Commissions\Infrastructure\Domain\CreditCard\RepositoryInterface\InMemoryImplementation as CreditCardRepository;
use Smolarium\Commissions\Infrastructure\Domain\Country\RepositoryInterface\InMemoryImplementation as CountryRepository;
use Smolarium\Commissions\Infrastructure\Domain\Money\ExchangerInterface\InMemoryImplementation as MoneyExchanger;

$application = new Application();
// @todo use dependency injection container
$processInputFileCommand = new ProcessInputFile(
    new Calculator(
        new CreditCardRepository(),
        new CountryRepository(),
        new MoneyExchanger()
    )
);
$application->add($processInputFileCommand);
$application->run();