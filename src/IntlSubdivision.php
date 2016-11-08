<?php
namespace Symfony\Component\IntlSubdivision;

use Symfony\Component\Intl\Data\Bundle\Reader\BufferedBundleReader;
use Symfony\Component\Intl\Data\Bundle\Reader\BundleEntryReader;
use Symfony\Component\Intl\Data\Bundle\Reader\BundleEntryReaderInterface;
use Symfony\Component\Intl\Data\Bundle\Reader\JsonBundleReader;
use Symfony\Component\IntlSubdivision\Subdivision\SubdivisionBundle;

final class IntlSubdivision implements IntlSubdivisionInterface
{
    /**
     * @var BundleEntryReaderInterface
     */
    private static $entryReader;

    public static function getSubdivisions()
    {
        static $subdivisionsBundle = null;
        if (null === $subdivisionsBundle) {
            $subdivisionsBundle = new SubdivisionBundle(
                self::getDataDirectory(),
                self::getEntryReader()
            );
        }

        return $subdivisionsBundle;
    }

    private static function getDataDirectory()
    {
        return realpath(__DIR__ . '/Resources/data');
    }

    /**
     * Returns the cached bundle entry reader.
     *
     * @return BundleEntryReaderInterface The bundle entry reader
     */
    private static function getEntryReader()
    {
        if (null === self::$entryReader) {
            self::$entryReader = new BundleEntryReader(
                new BufferedBundleReader(
                    new JsonBundleReader(),
                    self::BUFFER_SIZE
                )
            );
        }

        return self::$entryReader;
    }
}
