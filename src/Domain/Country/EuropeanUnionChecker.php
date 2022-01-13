<?php

declare(strict_types = 1);

namespace Smolarium\Commissions\Domain\Country;

use Smolarium\Commissions\Domain\Country;

class EuropeanUnionChecker
{
    private const EuropeanUnionCountries = [
        'AT',
        'BE',
        'BG',
        'CY',
        'CZ',
        'DE',
        'DK',
        'EE',
        'ES',
        'FI',
        'FR',
        'GR',
        'HR',
        'HU',
        'IE',
        'IT',
        'LT',
        'LU',
        'LV',
        'MT',
        'NL',
        'PO',
        'PT',
        'RO',
        'SE',
        'SI',
        'SK',
    ];

    public static function isFromEuropeanUnion(Country $country) : bool
    {
        return in_array($country->getCode()->getCode(), static::EuropeanUnionCountries, true);
    }
}
