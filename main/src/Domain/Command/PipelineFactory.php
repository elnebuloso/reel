<?php

namespace App\Domain\Command;

use App\Domain\Command\Pipeline;
use Generator;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Yaml\Yaml;

/**
 * PipelineFactory
 */
class PipelineFactory
{
    /**
     * @var Finder
     */
    private Finder $finder;

    /**
     * @param Finder $finder
     */
    public function __construct(Finder $finder)
    {
        $this->finder = $finder;
    }

    /**
     * @param string $directory
     * @param string $prefix
     * @return Generator<Pipeline>
     */
    public function createPipelines(string $directory, string $prefix = ""): Generator
    {
        $this->finder->name("*.yml");
        $this->finder->files()->in($directory);
        $this->finder->files()->sort(function ($a, $b) {
            // First, sort by directory depth (deeper paths come first)
            $depthDifference = substr_count($b->getRealPath(), DIRECTORY_SEPARATOR) - substr_count($a->getRealPath(), DIRECTORY_SEPARATOR);

            if ($depthDifference !== 0) {
                return $depthDifference;
            }

            // If depths are equal, then sort by the entire path
            $pathComparison = strcmp($a->getRelativePath(), $b->getRelativePath());

            if ($pathComparison !== 0) {
                return $pathComparison;
            }

            // If paths are the same, then sort by the filename
            return strcmp($a->getBasename(), $b->getBasename());
        });

        foreach ($this->finder as $file) {
            yield $this->createPipeline($file, $prefix);
        }
    }

    /**
     * @param SplFileInfo $fileInfo
     * @param string $prefix
     * @return Pipeline
     */
    public function createPipeline(SplFileInfo $fileInfo, string $prefix = ""): Pipeline
    {
        $path = trim($fileInfo->getRelativePath(), "/");

        $name = explode("/", $path);
        $name[] = $fileInfo->getFilenameWithoutExtension();

        if (!empty($prefix)) {
            array_unshift($name, $prefix);
        }

        return new Pipeline(implode(":", $name), Yaml::parseFile($fileInfo->getRealPath()));
    }
}
