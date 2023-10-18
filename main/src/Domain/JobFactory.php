<?php

namespace App\Domain;

use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Yaml\Yaml;

/**
 * JobFactory
 */
class JobFactory
{
    /**
     * @param SplFileInfo $file
     * @param array $data
     * @param string $prefix
     * @return Job
     */
    public function create(SplFileInfo $file, array $data, string $prefix = ""): Job
    {
        $path = trim($file->getRelativePath(), "/");

        $name = explode("/", $path);
        $name[] = $file->getFilenameWithoutExtension();

        if (!empty($prefix)) {
            array_unshift($name, $prefix);
        }

        $name = implode(":", $name);

        return new Job($file, $name, $data);
    }
}
