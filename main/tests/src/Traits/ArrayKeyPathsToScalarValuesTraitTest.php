<?php

namespace AppTests\Traits;

use App\Domain\Glue\Trait\ArrayKeyPathsToScalarValuesTrait;
use PHPUnit\Framework\TestCase;

/**
 * ArrayKeyPathsToScalarValuesTraitTest
 */
class ArrayKeyPathsToScalarValuesTraitTest extends TestCase
{
    use ArrayKeyPathsToScalarValuesTrait;

    /**
     * @test
     * @return void
     */
    public function testTrait(): void
    {
        $expected = ["a", "b.a", "b.b.a", "b.c", "c.a.a", "c.a.b", "c.a.c.a", "c.b"];

        $data = [
            "a" => "xxx",
            "b" => [
                "a" => "xxx",
                "b" => [
                    "a" => "xxx",
                ],
                "c" => "xxx",
            ],
            "c" => [
                "a" => [
                    "a" => "xxx",
                    "b" => "xxx",
                    "c" => [
                        "a" => "xxx",
                    ],
                ],
                "b" => "xxx",
            ],
        ];

        $this->assertEquals($expected, $this->arrayKeyPathsToScalarValues($data));
    }
}
