<?php

namespace AppTests\Domain\Glue\Trait;

use App\Domain\Glue\Trait\StringOrNullTrait;
use PHPUnit\Framework\TestCase;

/**
 * StringOrNullTraitTest
 */
class StringOrNullTraitTest extends TestCase
{
    use StringOrNullTrait;

    /**
     * @test
     * @param mixed $value
     * @param mixed $expected
     * @return void
     * @dataProvider traitDataProvider
     */
    public function testTrait(mixed $value, mixed $expected): void
    {
        $this->assertEquals($expected, $this->stringOrNull($value));
    }

    /**
     * @return array
     */
    public function traitDataProvider(): array
    {
        return [[null, null], ["", null], [" ", null], [" /FOO /", "FOO"]];
    }
}
