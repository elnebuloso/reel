<?php

namespace App\Domain;

use App\Domain\Glue\FinderFactory;
use App\Domain\Glue\YamlParserFactory;
use Symfony\Component\Finder\SplFileInfo;

/**
 * ReelFactory
 */
class ReelFactory
{
    /**
     * @var FinderFactory
     */
    private FinderFactory $finderFactory;

    /**
     * @var YamlParserFactory
     */
    private YamlParserFactory $yamlParserFactory;

    /**
     * @var JobFactory
     */
    private JobFactory $jobFactory;

    /**
     * @param FinderFactory $finderFactory
     * @param YamlParserFactory $yamlParserFactory
     * @param JobFactory $jobFactory
     */
    public function __construct(FinderFactory $finderFactory, YamlParserFactory $yamlParserFactory, JobFactory $jobFactory)
    {
        $this->finderFactory = $finderFactory;
        $this->yamlParserFactory = $yamlParserFactory;
        $this->jobFactory = $jobFactory;
    }

    /**
     * @param Config $config
     * @return Reel
     * @noinspection PhpUnnecessaryLocalVariableInspection
     */
    public function create(Config $config): Reel
    {
        $reel = new Reel();
        $reel = $this->buildJobs($reel, $config);

        return $reel;
    }

    /**
     * @param Reel $reel
     * @param Config $config
     * @return Reel
     */
    private function buildJobs(Reel $reel, Config $config): Reel
    {
        foreach ($config->getDirectories() as $directory) {
            $finder = $this->finderFactory->create();
            $finder->name("*.yml");
            $finder->files()->in($directory->getPath());

            foreach ($finder as $file) {
                $data = $this->readDefinition($file, Job::KIND);

                if (null !== $data) {
                    $reel->addJob($this->jobFactory->create($file, $data, $directory->getPrefix()));
                }
            }
        }

        return $reel;
    }

    /**
     * @param SplFileInfo $file
     * @param string $kind
     * @return array|null
     */
    private function readDefinition(SplFileInfo $file, string $kind): ?array
    {
        $yamlParser = $this->yamlParserFactory->create();
        $data = (array)$yamlParser->parseFile($file->getRealPath());

        if (!array_key_exists("kind", $data)) {
            return null;
        }

        if ($data[Job::FIELD_KIND] !== $kind . "/" . Reel::VERSION) {
            return null;
        }

        return $data;
    }
}
