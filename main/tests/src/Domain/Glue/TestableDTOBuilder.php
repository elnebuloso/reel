<?php

namespace AppTests\Domain\Glue;

use App\Domain\Glue\AbstractDTOBuilder;

/**
 * TestableDTOBuilder
 */
class TestableDTOBuilder extends AbstractDTOBuilder
{
    /**
     * @return TestableDTO
     */
    public function build(): TestableDTO
    {
        return new TestableDTO($this->data);
    }
}
