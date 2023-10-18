<?php

namespace App\Domain\Glue;

use Jasny\DotKey\DotKey;
use JsonSerializable;

/**
 * AbstractDTO
 */
abstract class AbstractDTO implements JsonSerializable
{
    /**
     * @var array
     */
    protected array $data;

    /**
     * @var array
     */
    protected array $defaults = [];

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = array_merge($this->defaults, $data);
    }

    /**
     * @param string $path
     * @param mixed|null $default
     * @return mixed
     */
    public function getValue(string $path, mixed $default = null): mixed
    {
        $default = $this->getDefault($path, $default);

        return DotKey::on($this->data)->exists($path) ? DotKey::on($this->data)->get($path) : $default;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->data;
    }

    /**
     * @param string $path
     * @param mixed|null $default
     * @return mixed
     */
    private function getDefault(string $path, mixed $default = null): mixed
    {
        return DotKey::on($this->defaults)->exists($path) ? DotKey::on($this->defaults)->get($path) : $default;
    }
}
