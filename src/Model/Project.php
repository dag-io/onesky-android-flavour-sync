<?php
namespace DAG\OneSky\Model;

/**
 * Class Project
 */
final class Project
{
    /** @var int Project id */
    private $id;

    /** @var StringFile[] Files */
    private $stringFiles;

    /**
     * Project constructor.
     *
     * @param int          $id
     * @param StringFile[] $stringFiles
     */
    public function __construct($id, array $stringFiles)
    {
        $this->id = $id;
        $this->stringFiles = $stringFiles;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return StringFile[]
     */
    public function getStringFiles()
    {
        return $this->stringFiles;
    }
}
