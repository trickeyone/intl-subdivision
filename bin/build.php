<?php

use Sokil\IsoCodes\IsoCodesFactory;
use Symfony\Component\Intl;

require_once __DIR__ . '/../vendor/autoload.php';
$output = [];
$isoCodes = new IsoCodesFactory();
$countries = $isoCodes->getCountries();
foreach ($countries as $country) {
    $countryCode = $country->getAlpha2();
    if (!$validCountry = Intl\Countries::exists($countryCode)) {
        echo \sprintf('Country %s: %s not found', $countryCode, $country->getName());
        continue;
    }
    if (!\array_key_exists($countryCode, $output)) {
        $output[$countryCode] = [];
    }
    $prefix = $countryCode . '-';
    $subdivisions = $isoCodes->getSubdivisions()->getAllByCountryCode($countryCode);
    if (empty($subdivisions)) {
        $output[$countryCode][$countryCode] = $country->getName();
    } else {
        foreach ($subdivisions as $subdivision) {
            $alphaCode = $subdivision->getCode();
            if (0 === \strpos($alphaCode, $prefix)) {
                $alphaCode = \substr($alphaCode, \strlen($prefix));
            }
            $subdivisionName = $subdivision->getName();
            if (false !== \strpos($subdivisionName, ';')) {
                $subdivisionName = \preg_replace('/^(.+);\s?(.+)$/', '$1 ($2)', $subdivisionName);
            }
            $output[$countryCode][$alphaCode] = $subdivisionName;
        }
    }
    \uksort($output[$countryCode], 'natSortKeys');
}
//ensure all Symfony alpha codes exist
foreach (Intl\Countries::getNames() as $alphaCode => $name) {
    if (!\array_key_exists($alphaCode, $output)) {
        $output[$alphaCode] = [
            $alphaCode => $name,
        ];
    }
}
\uksort($output, 'natSortKeys');
\file_put_contents(__DIR__ . '/../tests/subdivisions.php', '<?php return ' . \var_export($output, true) . ';');
$output = \json_encode([
    'Version' => date('Y-m'),
    'Subdivisions' => $output,
], JSON_PRETTY_PRINT);
\file_put_contents(__DIR__ . '/../src/Resources/data/en.json', $output);
function natSortKeys($a, $b)
{
    return \strnatcmp($a, $b);
}
