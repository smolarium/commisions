<?php

declare(strict_types = 1);

namespace Smolarium\Commissions\Infrastructure\Console\Command;

use Smolarium\Commissions\Domain\Commission\Calculator;
use Smolarium\Commissions\Infrastructure\Domain\Payment\Factory\FromJsonImplementation as FromJsonPaymentFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProcessInputFile extends Command
{
    protected static $defaultName = 'app:process';
    protected static $description = 'Calculates commissions';
    private Calculator $calculator;

    public function __construct(Calculator $calculator)
    {
        $this->calculator = $calculator;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('inputFile', InputArgument::REQUIRED, 'path to the input file?');
    }

    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        $inputFilePath = $input->getArgument('inputFile');
        if ($file = fopen($inputFilePath, "r")) {
            while (!feof($file)) {
                $line = fgets($file);
                $payment = FromJsonPaymentFactory::createFromJson($line);
                $commission = $this->calculator->calculate($payment);
                echo number_format($commission->getMoney()->getAmount() / 100, 2) . PHP_EOL;
            }

            fclose($file);
            return Command::SUCCESS;
        }

        return Command::INVALID;
    }
}
