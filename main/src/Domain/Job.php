<?php

namespace App\Domain;

use Symfony\Component\Finder\SplFileInfo;

/**
 * Job
 */
class Job
{
    public const FIELD_KIND = "kind";

    private const FIELD_DESC = "desc";

    private const FIELD_SCRIPTS = "scripts";

    /**
     * @var SplFileInfo
     */
    private SplFileInfo $file;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var array
     */
    private array $data;

    /**
     * @param SplFileInfo $file
     * @param string $name
     * @param array $data
     */
    public function __construct(SplFileInfo $file, string $name, array $data)
    {
        $this->file = $file;
        $this->name = $name;
        $this->data = $data;
    }

    /**
     * @return SplFileInfo
     */
    public function getFile(): SplFileInfo
    {
        return $this->file;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getKind(): string
    {
        return $this->data[self::FIELD_KIND];
    }

    /**
     * @return string
     */
    public function getDesc(): string
    {
        return $this->data[self::FIELD_DESC];
    }

    /**
     * @return array
     */
    public function getScripts(): array
    {
        return $this->data[self::FIELD_SCRIPTS];
    }
}
