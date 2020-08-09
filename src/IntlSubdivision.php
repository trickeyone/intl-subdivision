<?php
namespace Symfony\Component\IntlSubdivision;

use Symfony\Component\Intl;

final class IntlSubdivision extends Intl\ResourceBundle implements IntlSubdivisionInterface
{
    private const SUBDIVISION_LOCALE = 'en';

    public static function getStatesAndProvincesForCountry(string $countryCode): array
    {
        $validCountry = Intl\Countries::exists($countryCode);
        if (!$validCountry) {
            throw new Intl\Exception\MissingResourceException('Invalid Country Code: ' . $countryCode);
        }

        return self::readEntry(['Subdivisions', $countryCode], self::SUBDIVISION_LOCALE);
    }

    public static function getStatesAndProvinces(): array
    {
        return self::readEntry(['Subdivisions'], self::SUBDIVISION_LOCALE);
    }

    protected static function getPath(): string
    {
        return realpath(__DIR__ . '/Resources/data');
    }
}
