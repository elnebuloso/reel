<?php

namespace App\Domain;

use App\Domain\Glue\FinderFactory;
use App\Domain\Glue\Trait\ArrayKeyPathsToScalarValuesTrait;
use App\Domain\Glue\YamlParserFactory;
use Jasny\DotKey\DotKey;
use Symfony\Component\Finder\SplFileInfo;

/**
 * ReelFactory
 */
class ReelFactory
{
    use ArrayKeyPathsToScalarValuesTrait;

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
        $reel = $this->buildProperties($reel, $config);

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
                $data = $this->readDefinition($file, "job");

                if(null === $data) {
                    continue;
                }

                    $reel->addJob($this->jobFactory->create($file, $data, $directory->getPrefix()));
            }
        }

        return $reel;
    }

    /**
     * @param Reel $reel
     * @param Config $config
     * @return Reel
     */
    private function buildProperties(Reel $reel, Config $config): Reel {
        foreach ($config->getDirectories() as $directory) {
            $finder = $this->finderFactory->create();
            $finder->name("*.yml");
            $finder->files()->in($directory->getPath());

            foreach ($finder as $file) {
                $data = $this->readDefinition($file, "properties");

                if(null === $data) {
                    continue;
                }

                if(!array_key_exists("properties", $data)) {
                    continue;
                }

                $data = $data["properties"];
                $paths = $this->arrayKeyPathsToScalarValues($data);

                foreach ($paths as $path) {
                    $reel->addProperty(new Property($file, $path, DotKey::on($data)->get($path)));
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

        if ($data["kind"] !== $kind . "/" . Reel::VERSION) {
            return null;
        }

        return $data;
    }
}
