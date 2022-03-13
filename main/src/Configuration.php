<?php

namespace App;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\ScalarNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder("redo");

        $rootNode = $treeBuilder->getRootNode();
        $rootNode->append($this->createVersionConfig());
        $rootNode->append($this->createPropertiesConfig());
        $rootNode->append($this->createBranchesConfig());

        return $treeBuilder;
    }

    /**
     * @return ScalarNodeDefinition
     */
    private function createVersionConfig(): ScalarNodeDefinition
    {
        $version = new ScalarNodeDefinition("version");
        $version->isRequired();
        $version->cannotBeEmpty();

        return $version;
    }

    /**
     * @return ArrayNodeDefinition
     */
    private function createPropertiesConfig(): ArrayNodeDefinition
    {
        $properties = new ArrayNodeDefinition("properties");
        $properties->useAttributeAsKey("name");
        $properties->prototype("scalar");

        return $properties;
    }

    /**
     * @return ArrayNodeDefinition
     */
    private function createBranchesConfig(): ArrayNodeDefinition
    {
        $branches = new ArrayNodeDefinition("branches");
        $branches->useAttributeAsKey("name");

        $branch = $branches->arrayPrototype();
        $branch = $branch->children();

        $branch->append($this->createRegexConfig());
        $branch->append($this->createPropertiesConfig());
        $branch->append($this->createDockerPushesConfig());

        return $branches;
    }

    /**
     * @return ScalarNodeDefinition
     */
    private function createRegexConfig(): ScalarNodeDefinition
    {
        $regex = new ScalarNodeDefinition("regex");
        $regex->isRequired();
        $regex->cannotBeEmpty();

        return $regex;
    }

    /**
     * @return ArrayNodeDefinition
     */
    private function createDockerPushesConfig(): ArrayNodeDefinition
    {
        $dockerPushes = new ArrayNodeDefinition("docker_pushes");
        $dockerPushes->scalarPrototype();

        return $dockerPushes;
    }
}
