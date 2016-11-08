<?php
namespace Symfony\Component\IntlSubdivisions;

interface IntlSubdivisionInterface
{
    const BUFFER_SIZE = 10;

    public static function getSubdivisions();
}
