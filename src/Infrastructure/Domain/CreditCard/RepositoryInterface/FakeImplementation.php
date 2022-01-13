<?php

declare(strict_types = 1);

namespace Smolarium\Commissions\Infrastructure\Domain\CreditCard\RepositoryInterface;

use Smolarium\Commissions\Domain\CreditCard;
use Smolarium\Commissions\Domain\CreditCard\Bin;
use Smolarium\Commissions\Domain\CreditCard\Repository\NotFound;
use Smolarium\Commissions\Domain\CreditCard\RepositoryInterface;
use Smolarium\Commissions\Infrastructure\Domain\CreditCard\Factory\ScalarImplementation;

class FakeImplementation implements RepositoryInterface
{
    private const knownBins = [
        45717360 => ['code' => 'DK'],
        516793 => ['code' => 'LT'],
        45417360 => ['code' => 'JP'],
        41417360 => ['code' => 'US'],
        4745030 => ['code' => 'GB'],
    ];

    public function getByBin(Bin $bin) : CreditCard
    {
        $binInt = $bin->getBin();
        if (!array_key_exists($binInt, $this::knownBins)) {
            throw new NotFound();
        }

        $countryCodeString = $this::knownBins[$binInt]['code'];
        return ScalarImplementation::createFromScalar($bin->getBin(), $countryCodeString);
    }
}
