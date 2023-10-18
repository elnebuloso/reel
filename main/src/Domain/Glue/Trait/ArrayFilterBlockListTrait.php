<?php

namespace App\Domain\Glue\Trait;

/**
 * ArrayFilterBlockListTrait
 */
trait ArrayFilterBlockListTrait
{
    /**
     * @param array $data
     * @param array $blockList
     * @return array
     */
    protected function arrayFilterBlockList(array $data, array $blockList): array
    {
        return array_diff_key($data, array_flip($blockList));
    }
}
