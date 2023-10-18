<?php

namespace App\Domain;

use Symfony\Component\Finder\SplFileInfo;

/**
 * Property
 */
class Property
{
    /**
     * @var string
     */
    private string $path;

    /**
     * @var mixed
     */
    private mixed $value;

    /**
     * @var SplFileInfo
     */
    private SplFileInfo $fileInfo;

    /**
     * @param string $path
     * @param mixed $value
     * @param SplFileInfo $fileInfo
     */
    public function __construct(string $path, mixed $value, SplFileInfo $fileInfo)
    {
        $this->path = $path;
        $this->value = $value;
        $this->fileInfo = $fileInfo;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return mixed
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

    /**
     * @return SplFileInfo
     */
    public function getFileInfo(): SplFileInfo
    {
        return $this->fileInfo;
    }
}
