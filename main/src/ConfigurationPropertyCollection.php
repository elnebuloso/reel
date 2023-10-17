<?php

namespace App;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

/**
 * ConfigurationPropertyCollection
 */
class ConfigurationPropertyCollection implements IteratorAggregate
{
    /**
     * @var array<ConfigurationProperty>
     */
    private array $properties = [];

    /**
     * @return Traversable<ConfigurationProperty>
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->properties);
    }

    /**
     * @param ConfigurationProperty $property
     * @return void
     */
    public function addProperty(ConfigurationProperty $property): void
    {
        $this->properties[$property->getName()] = $property;
    }
}
