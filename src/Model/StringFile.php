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

    /** @var boolean True if this language is the base language (Usually english) */
    private $base;

    /**
     * StringFile constructor.
     *
     * @param string $path
     * @param string $locale
     * @param boolean $base
     */
    public function __construct($path, $locale, $base)
    {
        $this->path = $path;
        $this->locale = $locale;
        $this->base = $base;
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

    /**
     * @return boolean
     */
    public function isBase()
    {
        return $this->base;
    }
}
