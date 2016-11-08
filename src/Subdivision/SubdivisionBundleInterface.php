<?php
namespace Symfony\Component\IntlSubdivisions\Subdivision;

interface SubdivisionBundleInterface
{
    /**
     * @param string $countryCode
     * @return array[]
     */
    public function getStatesAndProvincesForCountry($countryCode);
}
