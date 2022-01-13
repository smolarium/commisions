<?php

declare(strict_types = 1);

namespace Smolarium\Commissions\Domain\Country;

use Smolarium\Commissions\Domain\Country;
use Smolarium\Commissions\Domain\Country\Repository\NotFound;

interface RepositoryInterface
{
    /**
     * @param Code $code
     * @return Country
     * @throws NotFound
     */
    public function getByCode(Code $code) : Country;
}
