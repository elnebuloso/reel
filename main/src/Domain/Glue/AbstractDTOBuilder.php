<?php

namespace App\Domain\Glue;

use Jasny\DotKey\DotKey;
use JsonSerializable;

/**
 * AbstractDTOBuilder
 */
abstract class AbstractDTOBuilder
{
    /**
     * @var array
     */
    protected array $data;

    /**
     * @param JsonSerializable $object
     */
    public function __construct(JsonSerializable $object)
    {
        $this->data = $object->jsonSerialize();
    }

    /**
     * @param string $path
     * @param mixed|null $default
     * @return mixed
     */
    public function getValue(string $path, mixed $default = null): mixed
    {
        return DotKey::on($this->data)->exists($path) ? DotKey::on($this->data)->get($path) : $default;
    }

    /**
     * @param string $path
     * @param mixed $value
     * @return $this
     */
    public function setValue(string $path, mixed $value): self
    {
        DotKey::on($this->data)->put($path, $value);

        return $this;
    }

    /**
     * @param string $path
     * @param array $values
     * @return $this
     */
    public function setValues(string $path, array $values): self
    {
        $this->setValue($path, []);
        $this->addValues($path, $values);

        return $this;
    }

    /**
     * @param string $path
     * @param array $values
     * @return $this
     */
    public function addValues(string $path, array $values): self
    {
        foreach ($values as $value) {
            $this->addValue($path, $value);
        }

        return $this;
    }

    /**
     * @param string $path
     * @param mixed $value
     * @return $this
     */
    public function addValue(string $path, mixed $value): self
    {
        $values = $this->getValue($path, []);
        $values[] = $value;

        $this->setValue($path, array_values($values));

        return $this;
    }

    /**
     * @param string $path
     * @return self
     */
    public function delValue(string $path): self
    {
        DotKey::on($this->data)->remove($path);

        return $this;
    }

    /**
     * @param string $from
     * @param string $to
     * @return $this
     */
    public function copyValue(string $from, string $to): self
    {
        if (!empty($this->getValue($from))) {
            $this->setValue($to, $this->getValue($from));
        }

        return $this;
    }

    /**
     * @param string $from
     * @param string $to
     * @return $this
     */
    public function moveValue(string $from, string $to): self
    {
        if (!empty($this->getValue($from))) {
            $this->setValue($to, $this->getValue($from));
            $this->delValue($from);
        }

        return $this;
    }
}
