<?php
namespace DAG\OneSky\Model;

/**
 * Class StringFile
 */
final class StringFile
{
    /** @var string Path to the file */
    private $path;

    /** @var string Locale (ex: en_US, ...) */
    private $locale;

    /**
     * StringFile constructor.
     *
     * @param string $path
     * @param string $locale
     */
    public function __construct($path, $locale)
    {
        $this->path = $path;
        $this->locale = $locale;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }
}
