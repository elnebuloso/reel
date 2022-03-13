<?php

namespace AppTests;

use App\Property;
use PHPUnit\Framework\TestCase;

/**
 * Class PropertyTestCase
 */
class PropertyTestCase extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function testConstruct(): void
    {
        $property = new Property("foo", "bar");
        $this->assertEquals("foo", $property->getName());
        $this->assertEquals("bar", $property->getValue());
    }
}
