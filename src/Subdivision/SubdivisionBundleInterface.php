<?php
namespace Symfony\Component\IntlSubdivision\Subdivision;

interface SubdivisionBundleInterface
{
    /**
     * @param string $countryCode
     * @return array[]
     */
    public function getStatesAndProvincesForCountry($countryCode);

    /**
     * @return array
     */
    public function getStatesAndProvinces();
}
