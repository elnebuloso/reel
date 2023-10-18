<?php

namespace App\Domain\Glue\Trait;

/**
 * StringOrNullTrait
 */
trait StringOrNullTrait
{
    /**
     * @param string|null $value
     * @return string|null
     */
    protected function stringOrNull(?string $value): ?string
    {
        $value = trim((string) $value);
        $value = trim($value, "/");
        $value = trim($value);

        return empty($value) ? null : $value;
    }
}
