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
        $rootNode->append($this->createVersion());
        $rootNode->append($this->createProperties());

        return $treeBuilder;
    }

    /**
     * @return ScalarNodeDefinition
     */
    private function createVersion(): ScalarNodeDefinition
    {
        $versionScalarNodeDefinition = new ScalarNodeDefinition("version");
        $versionScalarNodeDefinition->isRequired();
        $versionScalarNodeDefinition->cannotBeEmpty();

        return $versionScalarNodeDefinition;
    }

    /**
     * @return ArrayNodeDefinition
     */
    private function createProperties(): ArrayNodeDefinition
    {
        $propertiesArrayNodeDefinition = new ArrayNodeDefinition("properties");
        $propertiesArrayNodeDefinition->useAttributeAsKey("name");
        $propertiesArrayNodeDefinition->prototype("scalar");

        return $propertiesArrayNodeDefinition;
    }
}
