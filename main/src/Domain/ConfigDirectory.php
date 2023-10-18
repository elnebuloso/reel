<?php

namespace App\Domain;

/**
 * ConfigDirectory
 */
class ConfigDirectory
{
    /**
     * @var string
     */
    private string $path;

    /**
     * @var string
     */
    private string $prefix;

    /**
     * @param string $path
     * @param string $prefix
     */
    public function __construct(string $path, string $prefix)
    {
        $this->path = $path;
        $this->prefix = $prefix;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }
}
