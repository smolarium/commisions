<?php

declare(strict_types = 1);

require(__DIR__ . '/../vendor/autoload.php');

use Symfony\Component\Console\Application;
use Smolarium\Commissions\Infrastructure\Console\Command\ProcessInputFile;
use Smolarium\Commissions\Infrastructure\Domain\Commission\Calculator\FactoryInterface\FakeImplementation as CalculatorFactory;

$application = new Application();
$calculatorFactory = new CalculatorFactory();
$calculator = $calculatorFactory->create();
$processInputFileCommand = new ProcessInputFile($calculator);
$application->add($processInputFileCommand);
$application->run();