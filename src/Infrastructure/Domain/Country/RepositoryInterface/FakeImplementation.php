<?php
declare(strict_types = 1);

namespace Smolarium\Commissions\Infrastructure\Domain\Country\RepositoryInterface;

use Smolarium\Commissions\Domain\Country;
use Smolarium\Commissions\Domain\Country\Repository\NotFound;
use Smolarium\Commissions\Domain\Country\Code;
use Smolarium\Commissions\Domain\Country\RepositoryInterface;

class FakeImplementation implements RepositoryInterface
{
    private const knownCountries = [
        'DK',
        'LT',
        'JP',
        'US',
        'GB',
    ];

    public function getByCode(Code $code) : Country
    {
        if (!in_array($code->getCode(), $this::knownCountries, true)) {
            throw new NotFound();
        }

        return new Country($code);
    }
}
