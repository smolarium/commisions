<?php

declare(strict_types = 1);

namespace Smolarium\Commissions\Domain\Commission\Calculator;

use Smolarium\Commissions\Domain\Commission\Calculator;

interface FactoryInterface
{
    public function create() : Calculator;
}
