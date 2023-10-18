<?php

namespace AppTests\Domain\Glue\Trait;

use App\Domain\Glue\Trait\ArrayFilterRecursiveTrait;
use PHPUnit\Framework\TestCase;

/**
 * ArrayFilterRecursiveTraitTest
 */
class ArrayFilterRecursiveTraitTest extends TestCase
{
    use ArrayFilterRecursiveTrait;

    /**
     * @test
     * @dataProvider dataProviderTrait
     * @param array $data
     * @param array $expected
     * @return void
     */
    public function testTrait(array $data, array $expected): void
    {
        $this->assertEquals($expected, $this->arrayFilterRecursive($data));
    }

    /**
     * @return array
     */
    private function dataProviderTrait(): array
    {
        return [
            [["a0" => "x", "b0" => null], ["a0" => "x"]],
            [["a0" => "x", "b0" => ""], ["a0" => "x"]],
            [["a0" => "x", "b0" => 0], ["a0" => "x", "b0" => 0]],
            [["a0" => "x", "b0" => false], ["a0" => "x", "b0" => false]],
            [["a0" => "x", "b0" => []], ["a0" => "x"]],
            [["a0" => "x", "b0" => ["b1.0" => "x", "b1.1" => null]], ["a0" => "x", "b0" => ["b1.0" => "x"]]],
            [["a0" => "x", "b0" => ["b1.0" => "x", "b1.1" => ""]], ["a0" => "x", "b0" => ["b1.0" => "x"]]],
            [["a0" => "x", "b0" => ["b1.0" => "x", "b1.1" => 0]], ["a0" => "x", "b0" => ["b1.0" => "x", "b1.1" => 0]]],
            [["a0" => "x", "b0" => ["b1.0" => null]], ["a0" => "x"]],
            [["a0" => "x", "b0" => ["b1.0" => ""]], ["a0" => "x"]],
            [["a0" => "x", "b0" => ["b1.0" => 0]], ["a0" => "x", "b0" => ["b1.0" => 0]]],
            [["a0" => "x", "b0" => ["b1.0" => false]], ["a0" => "x", "b0" => ["b1.0" => false]]],
        ];
    }
}
