<?php

namespace App;

/**
 * CommandConfig
 */
class CommandConfig
{
    /**
     * @var string
     */
    private string $name;

    /**
     * @var array
     */
    private array $data;

    /**
     * @param string $name
     * @param array $data
     */
    public function __construct(string $name, array $data)
    {
        $this->name = $name;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDesc(): string
    {
        return $this->data["desc"];
    }

    /**
     * @return array
     */
    public function getScripts(): array
    {
        return $this->data["scripts"];
    }
}
