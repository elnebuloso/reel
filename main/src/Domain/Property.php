<?php

namespace App\Domain;

use Symfony\Component\Finder\SplFileInfo;

/**
 * Property
 */
class Property
{
    /**
     * @var SplFileInfo
     */
    private SplFileInfo $file;

    /**
     * @var string
     */
    private string $path;

    /**
     * @var mixed
     */
    private mixed $value;

    /**
     * @param SplFileInfo $file
     * @param string $path
     * @param mixed $value
     */
    public function __construct(SplFileInfo $file, string $path, mixed $value)
    {
        $this->file = $file;
        $this->path = $path;
        $this->value = $value;
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
}
