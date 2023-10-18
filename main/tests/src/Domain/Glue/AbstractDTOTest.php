<?php

namespace AppTests\Domain\Glue;

use PHPUnit\Framework\TestCase;

/**
 * AbstractDTOTest
 */
class AbstractDTOTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function testObject(): void
    {
        $demo = new TestableDTO();
        $this->assertEquals(null, $demo->getValue("name"));
        $this->assertEquals("foo", $demo->getValue("name", "foo"));
        $this->assertEquals([], $demo->jsonSerialize());

        $demo = new TestableDTO(["name" => "bar", "tags" => ["foo"]]);
        $this->assertEquals("bar", $demo->getValue("name"));
        $this->assertEquals(["foo"], $demo->getValue("tags"));
        $this->assertEquals(["name" => "bar", "tags" => ["foo"]], $demo->jsonSerialize());

        $demo = new TestableDTO(["this" => ["is" => ["a" => ["value" => "foo"]]]]);
        $this->assertEquals("foo", $demo->getValue("this.is.a.value"));
    }
}
