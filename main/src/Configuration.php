<?php

namespace App;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\Config\Definition\Builder\ScalarNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Class Configuration
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @var ConfigurationPropertyCollection
     */
    private ConfigurationPropertyCollection $properties;

    /**
     * construct
     */
    public function __construct()
    {
        $configuration = Yaml::parseFile(__DIR__ . "/Configuration.yml");

        $this->properties = new ConfigurationPropertyCollection();
        $this->buildProperties($configuration["properties"]);
    }

    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder("redo");

        $rootNode = $treeBuilder->getRootNode();
        $rootNode->append($this->createVersionNode());
        $rootNode->append($this->createPropertiesNode());

        return $treeBuilder;
    }

    /**
     * @return ScalarNodeDefinition
     */
    private function createVersionNode(): ScalarNodeDefinition
    {
        $version = new ScalarNodeDefinition("version");
        $version->isRequired();
        $version->cannotBeEmpty();

        return $version;
    }

    /**
     * @return ArrayNodeDefinition
     */
    private function createPropertiesNode(): ArrayNodeDefinition
    {
        $properties = new ArrayNodeDefinition("properties");

        foreach ($this->properties as $property) {
            $this->createPropertyNode($property, $properties);
        }

        return $properties;
    }

    /**
     * @param ConfigurationProperty $property
     * @param ArrayNodeDefinition $parentNode
     * @return void
     */
    private function createPropertyNode(ConfigurationProperty $property, ArrayNodeDefinition $parentNode): void
    {
        if ($property->getType() === ConfigurationProperty::TYPE_ARRAY) {
            $node = new ArrayNodeDefinition($property->getName());

            foreach ($property->getProperties() as $child) {
                $this->createPropertyNode($child, $node);
            }

            if (empty($property->getProperties())) {
                $node->prototype("scalar");
            }
        } else {
            $node = new ScalarNodeDefinition($property->getName());
        }

        $parentNode->children()->append($node);
    }

    /**
     * @param array $configuration
     * @param ConfigurationProperty|null $parent
     * @return void
     */
    private function buildProperties(array $configuration, ?ConfigurationProperty $parent = null): void
    {
        foreach ($configuration as $name => $data) {
            $property = new ConfigurationProperty($name, $parent);
            $property->setType($data["type"]);

            if (array_key_exists("properties", $data) && is_array($data["properties"])) {
                $this->buildProperties($data["properties"], $property);
            }

            if ($parent !== null) {
                $parent->addProperty($property);
            } else {
                $this->properties->addProperty($property);
            }
        }
    }
}
