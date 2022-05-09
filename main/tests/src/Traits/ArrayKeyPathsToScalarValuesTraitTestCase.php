<?php

namespace AppTests\Traits;

use App\Traits\ArrayKeyPathsToScalarValuesTrait;
use PHPUnit\Framework\TestCase;

/**
 * Class ArrayKeyPathsToScalarValuesTraitTestCase
 */
class ArrayKeyPathsToScalarValuesTraitTestCase extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function testTrait(): void
    {
        $trait = $this->getMockBuilder(ArrayKeyPathsToScalarValuesTrait::class)->getMockForTrait();

        $expected = ["a", "b.a", "b.b.a", "b.c", "c.a.a", "c.a.b", "c.a.c.a", "c.b"];

        $this->assertEquals(
            $expected,
            $trait->arrayKeyPathsToScalarValues([
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
            ]),
        );
    }
}
