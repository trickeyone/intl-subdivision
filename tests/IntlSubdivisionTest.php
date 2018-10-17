<?php
namespace Symfony\Component\IntlSubdivision;

use PHPUnit\Framework\TestCase;
use Symfony\Component\IntlSubdivision\Subdivision\SubdivisionBundleInterface;

class IntlSubdivisionTest extends TestCase
{
    public function testGetSubdivisions()
    {
        $result = IntlSubdivision::getSubdivisions();

        self::assertInstanceOf(SubdivisionBundleInterface::class, $result);
    }
}
