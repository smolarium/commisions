<?php

declare(strict_types = 1);

require(__DIR__ . '/../vendor/autoload.php');

use Symfony\Component\Console\Application;
use Smolarium\Commissions\Infrastructure\Console\Command\ProcessInputFile;

$application = new Application();
$application->add(new ProcessInputFile());
$application->run();