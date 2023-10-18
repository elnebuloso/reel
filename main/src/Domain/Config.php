<?php

namespace App\Domain;

/**
 * Config
 */
class Config
{
    /**
     * @var array<ConfigDirectory>
     */
    private array $directories = [];

    /**
     * @param ConfigDirectory $configDirectory
     * @return void
     */
    public function addDirectory(ConfigDirectory $configDirectory): void
    {
        if (realpath($configDirectory->getPath())) {
            $this->directories[] = $configDirectory;
        }
    }

    /**
     * @return array<ConfigDirectory>
     */
    public function getDirectories(): array
    {
        return $this->directories;
    }
}
