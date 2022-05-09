<?php

namespace App;

/**
 * Class ConfigurationProperty
 */
class ConfigurationProperty
{
    const TYPE_ARRAY = "array";

    /**
     * @var string
     */
    private string $name;

    /**
     * @var ConfigurationProperty|null
     */
    private ?ConfigurationProperty $parent;

    /**
     * @var string|null
     */
    private ?string $type = null;

    /**
     * @var string|null
     */
    private ?string $info = null;

    /**
     * @var bool
     */
    private bool $sensitive = false;

    /**
     * @var array<ConfigurationProperty>
     */
    private array $properties = [];

    /**
     * @param string $name
     * @param ConfigurationProperty|null $parent
     */
    public function __construct(string $name, ?ConfigurationProperty $parent = null)
    {
        $this->name = $name;
        $this->parent = $parent;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return ConfigurationProperty|null
     */
    public function getParent(): ?ConfigurationProperty
    {
        return $this->parent;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string|null
     */
    public function getInfo(): ?string
    {
        return $this->info;
    }

    /**
     * @param string|null $info
     */
    public function setInfo(?string $info): void
    {
        $this->info = $info;
    }

    /**
     * @return bool
     */
    public function isSensitive(): bool
    {
        return $this->sensitive;
    }

    /**
     * @param bool $sensitive
     */
    public function setSensitive(bool $sensitive): void
    {
        $this->sensitive = $sensitive;
    }

    /**
     * @return ConfigurationProperty[]
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /**
     * @param ConfigurationProperty $property
     * @return void
     */
    public function addProperty(ConfigurationProperty $property): void
    {
        $this->properties[$property->getName()] = $property;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        $path = [];

        if ($this->parent instanceof ConfigurationProperty) {
            $path[] = $this->parent->getPath();
        }

        $path[] = $this->getName();

        return implode(".", $path);
    }
}
