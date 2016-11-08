<?php
namespace Symfony\Component\IntlSubdivision;

use Symfony\Component\IntlSubdivision\Subdivision\SubdivisionBundleInterface;

class IntlSubdivisionTest extends \PHPUnit_Framework_TestCase
{
    public function testGetSubdivisions()
    {
        $result = IntlSubdivision::getSubdivisions();

        self::assertInstanceOf(SubdivisionBundleInterface::class, $result);
    }
}
