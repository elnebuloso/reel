<?php

namespace AppTests\Domain\Glue;

use PHPUnit\Framework\TestCase;

/**
 * AbstractDTOBuilderTest
 */
class AbstractDTOBuilderTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function testValue(): void
    {
        $demo = (new TestableDTOBuilder(new TestableDTO()))->setValue("name", "foo")->build();
        $this->assertEquals("foo", $demo->getValue("name"));
        $this->assertEquals(["name" => "foo"], $demo->jsonSerialize());
    }

    /**
     * @test
     * @return void
     */
    public function testValues(): void
    {
        $demo = (new TestableDTOBuilder(new TestableDTO()))->addValue("tags", "foo")->build();
        $this->assertEquals(["foo"], $demo->getValue("tags"));

        $demo = (new TestableDTOBuilder($demo))->addValue("tags", "bar")->build();
        $this->assertEquals(["foo", "bar"], $demo->getValue("tags"));

        $demo = (new TestableDTOBuilder($demo))->addValues("tags", ["baz"])->build();
        $this->assertEquals(["foo", "bar", "baz"], $demo->getValue("tags"));

        $demo = (new TestableDTOBuilder($demo))->setValues("tags", ["bat"])->build();
        $this->assertEquals(["bat"], $demo->getValue("tags"));
    }

    /**
     * @test
     * @return void
     */
    public function testCopyValue(): void
    {
        $demo = (new TestableDTOBuilder(new TestableDTO()))->setValue("name", "foo")->build();
        $this->assertEquals("foo", $demo->getValue("name"));
        $this->assertEquals(["name" => "foo"], $demo->jsonSerialize());

        $demo = (new TestableDTOBuilder($demo))->copyValue("name", "title")->build();
        $this->assertEquals("foo", $demo->getValue("name"));
        $this->assertEquals("foo", $demo->getValue("title"));
        $this->assertEquals(["name" => "foo", "title" => "foo"], $demo->jsonSerialize());
    }

    /**
     * @test
     * @return void
     */
    public function testMoveValue(): void
    {
        $demo = (new TestableDTOBuilder(new TestableDTO()))->setValue("name", "foo")->build();
        $this->assertEquals("foo", $demo->getValue("name"));
        $this->assertEquals(["name" => "foo"], $demo->jsonSerialize());

        $demo = (new TestableDTOBuilder($demo))->moveValue("name", "title")->build();
        $this->assertEquals(null, $demo->getValue("name"));
        $this->assertEquals("foo", $demo->getValue("title"));
        $this->assertEquals(["title" => "foo"], $demo->jsonSerialize());
    }
}
