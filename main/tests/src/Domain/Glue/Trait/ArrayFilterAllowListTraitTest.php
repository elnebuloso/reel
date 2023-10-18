<?php

namespace AppTests\Domain\Glue\Trait;

use App\Domain\Glue\Trait\ArrayFilterAllowListTrait;
use PHPUnit\Framework\TestCase;

/**
 * ArrayFilterAllowListTraitTest
 */
class ArrayFilterAllowListTraitTest extends TestCase
{
    use ArrayFilterAllowListTrait;

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

        $allowList = ["foo"];

        $expected = ["foo" => "1"];

        $this->assertEquals($expected, $this->arrayFilterAllowList($data, $allowList));
    }
}
