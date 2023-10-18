<?php

namespace AppTests\Domain\Glue\Trait;

use App\Domain\Glue\Trait\ArrayFilterBlockListTrait;
use PHPUnit\Framework\TestCase;

/**
 * ArrayFilterBlockListTraitTest
 */
class ArrayFilterBlockListTraitTest extends TestCase
{
    use ArrayFilterBlockListTrait;

    /**
     * @test
     * @return void
     */
    public function testTrait(): void
    {
        $data = [
            "foo" => "1",
            "bar" => "2",
            "baz" => "3",
        ];

        $blockList = ["foo"];

        $expected = ["bar" => "2", "baz" => "3"];

        $this->assertEquals($expected, $this->arrayFilterBlockList($data, $blockList));
    }
}
