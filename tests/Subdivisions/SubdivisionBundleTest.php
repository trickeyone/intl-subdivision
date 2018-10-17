<?php
namespace Symfony\Component\IntlSubdivision\Subdivision;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Intl\Data\Bundle\Reader\BufferedBundleReader;
use Symfony\Component\Intl\Data\Bundle\Reader\BundleEntryReader;
use Symfony\Component\Intl\Data\Bundle\Reader\BundleEntryReaderInterface;
use Symfony\Component\Intl\Data\Bundle\Reader\JsonBundleReader;
use Symfony\Component\Intl\Exception\MissingResourceException;
use Symfony\Component\IntlSubdivision\IntlSubdivision;

class SubdivisionBundleTest extends TestCase
{
    protected $country = 'US';
    private $path = __DIR__ . '/../Resources/data';
    /**
     * @var SubdivisionBundleInterface
     */
    private $subdivisionBundle;
    /**
     * @var BundleEntryReaderInterface
     */
    private $reader;

    public function testGetStatesAndProvinces()
    {
        $result = $this->subdivisionBundle->getStatesAndProvinces();

        self::assertNotEmpty($result);
        self::assertArrayHasKey('US', $result);
        self::assertArrayHasKey('CA', $result['US']);
        self::assertArrayHasKey('MO', $result['US']);
        self::assertArrayHasKey('TX', $result['US']);
    }

    public function testGetStatesAndProvincesForCountry()
    {
        $result = $this->subdivisionBundle->getStatesAndProvincesForCountry($this->country);

        self::assertNotEmpty($result);
        self::assertArrayHasKey('CA', $result);
        self::assertArrayHasKey('MO', $result);
        self::assertArrayHasKey('TX', $result);
    }

    public function testGetStatesAndProvincesForCountryThrowsMissingResourceException()
    {
        $badCountry = '0Z';

        self::expectException(MissingResourceException::class);

        $this->subdivisionBundle->getStatesAndProvincesForCountry($badCountry);
    }

    protected function setUp()
    {
        $this->reader = new BundleEntryReader(
            new BufferedBundleReader(
                new JsonBundleReader(),
                IntlSubdivision::BUFFER_SIZE
            )
        );
        $this->subdivisionBundle = new SubdivisionBundle($this->path, $this->reader);
    }
}
