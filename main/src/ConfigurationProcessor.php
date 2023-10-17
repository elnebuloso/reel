<?php

namespace App;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Yaml\Yaml;

/**
 * ConfigurationProcessor
 */
class ConfigurationProcessor
{
    /**
     * @param array $files
     * @return array
     */
    public function process(array $files): array
    {
        $configs = [];

        foreach ($files as $file) {
            $configs[] = Yaml::parseFile($file);
        }

        $processor = new Processor();
        $configuration = new Configuration();

        return $processor->processConfiguration($configuration, $configs);
    }
}
