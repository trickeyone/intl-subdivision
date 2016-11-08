<?php
namespace Symfony\Component\IntlStates;

use Symfony\Component\IntlSubdivisions\IntlSubdivision;
use Symfony\Component\IntlSubdivisions\Subdivision\SubdivisionBundle;

class IntlSubdivisionsTest extends \PHPUnit_Framework_TestCase
{
    public function testGetSubdivisions()
    {
        $result = IntlSubdivision::getSubdivisions();

        self::assertInstanceOf(SubdivisionBundle::class, $result);
    }
}
