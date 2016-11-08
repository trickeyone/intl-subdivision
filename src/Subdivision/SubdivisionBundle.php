<?php
namespace Symfony\Component\IntlSubdivision\Subdivision;

use Symfony\Component\Intl\Data\Bundle\Reader\BundleEntryReaderInterface;
use Symfony\Component\Intl\Exception\MissingResourceException;
use Symfony\Component\Intl\Intl;

class SubdivisionBundle implements SubdivisionBundleInterface
{
    /**
     * @var string
     */
    private $path;
    /**
     * @var BundleEntryReaderInterface
     */
    private $reader;
    private $subdivisionFilename = 'Subdivisions';

    public function __construct($path, BundleEntryReaderInterface $reader)
    {
        $this->path = $path;
        $this->reader = $reader;
    }

    /**
     * @param string $countryCode
     * @return array[]
     */
    public function getStatesAndProvincesForCountry($countryCode)
    {
        $validCountry = Intl::getRegionBundle()->getCountryName($countryCode);
        if (!$validCountry) {
            throw new MissingResourceException('Invalid Country Code: ' . $countryCode);
        }

        return $this->reader->readEntry($this->path, $this->subdivisionFilename, ['Subdivisions', $countryCode]);
    }

    /**
     * @return array
     */
    public function getStatesAndProvinces()
    {
        return $this->reader->readEntry($this->path, $this->subdivisionFilename, ['Subdivisions']);
    }
}
