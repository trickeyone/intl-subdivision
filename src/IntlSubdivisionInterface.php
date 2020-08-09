<?php
namespace Symfony\Component\IntlSubdivision;

interface IntlSubdivisionInterface
{
    public static function getStatesAndProvincesForCountry(string $countryCode): array;

    public static function getStatesAndProvinces(): array;
}
