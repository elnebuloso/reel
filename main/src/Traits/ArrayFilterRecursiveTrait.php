<?php

namespace App\Traits;

/**
 * ArrayFilterRecursiveTrait
 */
trait ArrayFilterRecursiveTrait
{
    /**
     * @param array $values
     * @return array
     */
    protected function arrayFilterRecursive(array $values): array
    {
        foreach ($values as &$value) {
            if (is_array($value)) {
                $value = $this->arrayFilterRecursive($value);
            }
        }

        return array_filter($values, function ($value) {
            return !empty($value) || is_numeric($value) || is_bool($value);
        });
    }
}
