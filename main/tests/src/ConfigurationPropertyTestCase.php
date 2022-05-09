<?php

namespace AppTests;

use App\ConfigurationProperty;
use PHPUnit\Framework\TestCase;

/**
 * Class ConfigurationPropertyTestCase
 */
class ConfigurationPropertyTestCase extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function testConstruct(): void
    {
        $configurationProperty = new ConfigurationProperty("foo");
        $this->assertEquals("foo", $configurationProperty->getName());
        $this->assertNull($configurationProperty->getParent());
        $this->assertNull($configurationProperty->getType());
        $this->assertNull($configurationProperty->getInfo());
        $this->assertFalse($configurationProperty->isSensitive());
        $this->assertCount(0, $configurationProperty->getProperties());
    }

    /**
     * @test
     * @return void
     */
    public function testParent(): void
    {
        $foo = new ConfigurationProperty("foo");
        $bar = new ConfigurationProperty("bar", $foo);

        $this->assertInstanceOf(ConfigurationProperty::class, $bar->getParent());
        $this->assertEquals("foo", $bar->getParent()->getName());
    }

    /**
     * @test
     * @return void
     */
    public function testType(): void
    {
        $configurationProperty = new ConfigurationProperty("foo");
        $configurationProperty->setType("scalar");
        $this->assertEquals("scalar", $configurationProperty->getType());
    }

    /**
     * @test
     * @return void
     */
    public function testInfo(): void
    {
        $configurationProperty = new ConfigurationProperty("foo");
        $configurationProperty->setInfo("this is the info");
        $this->assertEquals("this is the info", $configurationProperty->getInfo());
    }

    /**
     * @test
     * @return void
     */
    public function testSensitive(): void
    {
        $configurationProperty = new ConfigurationProperty("foo");
        $configurationProperty->setSensitive(true);
        $this->assertTrue($configurationProperty->isSensitive());
    }

    /**
     * @test
     * @return void
     */
    public function testProperties(): void
    {
        $configurationProperty = new ConfigurationProperty("foo");
        $configurationProperty->addProperty(new ConfigurationProperty("bar"));
        $configurationProperty->addProperty(new ConfigurationProperty("baz"));
        $configurationProperty->addProperty(new ConfigurationProperty("baz"));
        $this->assertCount(2, $configurationProperty->getProperties());
    }

    /**
     * @test
     * @return void
     */
    public function testPath(): void
    {
        $foo = new ConfigurationProperty("foo");
        $bar = new ConfigurationProperty("bar", $foo);
        $baz = new ConfigurationProperty("baz", $bar);

        $this->assertEquals("foo", $foo->getPath());
        $this->assertEquals("foo.bar", $bar->getPath());
        $this->assertEquals("foo.bar.baz", $baz->getPath());
    }
}
