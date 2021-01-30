<?php
namespace Symfony\Component\IntlSubdivision\Test;

use PHPUnit\Framework\TestCase;
use Sokil\IsoCodes;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Exception\MissingResourceException;
use Symfony\Component\IntlSubdivision\IntlSubdivision;
use function array_keys;
use function natsort;

class IntlSubdivisionTest extends TestCase
{
    const COUNTRY = 'US';

    public function testGetStatesAndProvinces()
    {
        $result = IntlSubdivision::getStatesAndProvinces();

        self::assertNotEmpty($result);
        self::assertArrayHasKey('US', $result);
        self::assertArrayHasKey('CA', $result['US']);
        self::assertArrayHasKey('MO', $result['US']);
        self::assertArrayHasKey('TX', $result['US']);
    }

    public function testGetStatesAndProvincesForCountry()
    {
        $result = IntlSubdivision::getStatesAndProvincesForCountry(self::COUNTRY);

        self::assertNotEmpty($result);
        self::assertArrayHasKey('CA', $result);
        self::assertArrayHasKey('MO', $result);
        self::assertArrayHasKey('TX', $result);
    }

    public function testGetStatesAndProvincesForCountryThrowsMissingResourceException()
    {
        $badCountry = '0Z';

        $this->expectException(MissingResourceException::class);

        IntlSubdivision::getStatesAndProvincesForCountry($badCountry);
    }

    public function testAllSymfonyCountriesArePresentInDatabase()
    {
        $countries = Countries::getCountryCodes();
        $result = array_keys(IntlSubdivision::getStatesAndProvinces());
        natsort($countries);
        natsort($result);

        self::assertSame($countries, $result);
    }

    /**
     * @dataProvider subdivisionsDataProvider
     * @param string $countryCode
     * @param array  $expectedSubdivisions
     */
    public function testGetStatesAndProvincesForCountryWithExpectedResult(string $countryCode, array $expectedSubdivisions)
    {
        self::assertTrue(Countries::exists($countryCode));
        $subdivisions = IntlSubdivision::getStatesAndProvincesForCountry($countryCode);
        self::assertIsArray($subdivisions);
        self::assertSame($expectedSubdivisions, $subdivisions);
    }

    public function subdivisionsDataProvider()
    {
        $isoCodes = new IsoCodes\IsoCodesFactory();

        return array_reduce(
            iterator_to_array($isoCodes->getCountries()),
            function (array $countries, IsoCodes\Database\Countries\Country $country) use ($isoCodes) {
                $countryCode = $country->getAlpha2();
                if (!Countries::exists($countryCode)) {
                    return $countries;
                }
                $subdivisions = $isoCodes->getSubdivisions()->getAllByCountryCode($countryCode);
                if (empty($subdivisions)) {
                    $countries[] = [$countryCode, [$countryCode => $country->getName()]];
                } else {
                    $prefix = $countryCode . '-';
                    $subdivisions = array_reduce(
                        $subdivisions,
                        function (
                            array $carry,
                            IsoCodes\Database\Subdivisions\Subdivision $subdivision
                        ) use (
                            $prefix
                        ) {
                            $alphaCode = preg_replace('/^' . $prefix . '/', '', $subdivision->getCode());
                            $subdivisionName = $subdivision->getName();
                            if (false !== strpos($subdivisionName, ';')) {
                                $subdivisionName = preg_replace('/^(.+);\s?(.+)$/', '$1 ($2)', $subdivisionName);
                            }
                            $carry[$alphaCode] = $subdivisionName;

                            return $carry;
                        },
                        []
                    );
                    uksort($subdivisions, 'strnatcmp');
                    $countries[] = [
                        $countryCode,
                        $subdivisions
                    ];
                }

                return $countries;
            },
            []
        );
    }
}
