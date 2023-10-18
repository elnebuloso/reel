<?php

namespace App\Traits;

/**
 * ArrayKeyPathsToScalarValuesTrait
 */
trait ArrayKeyPathsToScalarValuesTrait
{
    /**
     * @param array $array
     * @param array $parentKeys
     * @param array $paths
     * @return array
     */
    protected function arrayKeyPathsToScalarValues(array $array, array $parentKeys = [], array &$paths = []): array
    {
        foreach ($array as $key => $value) {
            $parentKeys[] = $key;

            if (is_array($value)) {
                $this->arrayKeyPathsToScalarValues($value, $parentKeys, $paths);
            }

            if (is_scalar($value)) {
                $paths[] = implode(".", $parentKeys);
            }

            array_pop($parentKeys);
        }

        return $paths;
    }
}
