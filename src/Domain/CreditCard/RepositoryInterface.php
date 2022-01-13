<?php

declare(strict_types = 1);

namespace Smolarium\Commissions\Domain\CreditCard;

use Smolarium\Commissions\Domain\CreditCard;
use Smolarium\Commissions\Domain\CreditCard\Repository\NotFound;

interface RepositoryInterface
{
    /**
     * @param Bin $bin
     * @return CreditCard
     * @throws NotFound
     */
    public function getByBin(Bin $bin) : CreditCard;
}
