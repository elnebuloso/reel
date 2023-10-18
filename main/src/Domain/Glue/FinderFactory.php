<?php

namespace App\Domain\Glue;

use Symfony\Component\Finder\Finder;

/**
 * FinderFactory
 */
class FinderFactory
{
    /**
     * @return Finder
     */
    public function create(): Finder
    {
        return new Finder();
    }
}
