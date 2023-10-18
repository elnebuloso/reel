<?php

namespace App\Traits;

/**
 * ArrayFilterAllowListTrait
 */
trait ArrayFilterAllowListTrait
{
    /**
     * @param array $data
     * @param array $allowList
     * @return array
     */
    protected function arrayFilterAllowList(array $data, array $allowList): array
    {
        return array_intersect_key($data, array_flip($allowList));
    }
}
