<?php

declare(strict_types = 1);

namespace Smolarium\Commissions\Infrastructure\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProcessInputFile extends Command
{
    protected static $defaultName = 'app:process';
    protected static $description = 'Calculates commissions';

    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        return Command::SUCCESS;
    }
}
