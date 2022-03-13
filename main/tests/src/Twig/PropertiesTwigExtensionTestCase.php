<?php

namespace AppTests\Twig;

use App\Twig\PropertiesTwigExtension;
use PHPUnit\Framework\TestCase;

/**
 * Class PropertiesTwigExtensionTestCase
 */
class PropertiesTwigExtensionTestCase extends TestCase
{
    /**
     * @test
     * @dataProvider filterProvider
     * @param int $key
     * @param string $name
     * @return void
     */
    public function testGetFilters(int $key, string $name): void
    {
        $extension = new PropertiesTwigExtension();
        $filters = $extension->getFilters();
        $this->assertEquals($name, $filters[$key]->getName());
    }

    /**
     * @return array
     */
    public function filterProvider(): array
    {
        return [[0, "md5"], [1, "sha1"], [2, "slugify"], [3, "basename"], [4, "truncate"]];
    }

    /**
     * @test
     * @return void
     */
    public function testMD5(): void
    {
        $extension = new PropertiesTwigExtension();
        $this->assertEquals("acbd18db4cc2f85cedef654fccc4a4d8", $extension->md5("foo"));
    }

    /**
     * @test
     * @return void
     */
    public function testSHA1(): void
    {
        $extension = new PropertiesTwigExtension();
        $this->assertEquals("0beec7b5ea3f0fdbc95d0dd47f3c5bc275da8a33", $extension->sha1("foo"));
    }

    /**
     * @test
     * @return void
     */
    public function testSlugify(): void
    {
        $text = "Dieser Slug ist ähnlich böse und überaus wie nichts! Das sag ich euch.";
        $slug = "dieser-slug-ist-aehnlich-boese-und-ueberaus-wie-nichts-das-sag-ich-euch";

        $extension = new PropertiesTwigExtension();
        $this->assertEquals($slug, $extension->slugify($text));
    }

    /**
     * @test
     * @return void
     */
    public function testBasename(): void
    {
        $extension = new PropertiesTwigExtension();
        $this->assertEquals("baz", $extension->basename("/foo/bar/baz"));
        $this->assertEquals("baz.txt", $extension->basename("/foo/bar/baz.txt"));
    }

    /**
     * @test
     * @return void
     */
    public function testTruncate(): void
    {
        $extension = new PropertiesTwigExtension();

        $text = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";

        $truncated = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
        $this->assertEquals($truncated, $extension->truncate($text, 50));

        $truncated = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx...";
        $this->assertEquals($truncated, $extension->truncate($text, 50, "..."));
    }

    /**
     * @test
     * @dataProvider functionProvider
     * @param int $key
     * @param string $name
     * @return void
     */
    public function testGetFunctions(int $key, string $name): void
    {
        $extension = new PropertiesTwigExtension();
        $functions = $extension->getFunctions();
        $this->assertEquals($name, $functions[$key]->getName());
    }

    /**
     * @return array
     */
    public function functionProvider(): array
    {
        return [
            [0, "env"],
            [1, "file"],
        ];
    }

    /**
     * @test
     * @return void
     */
    public function testEnv(): void
    {
        $extension = new PropertiesTwigExtension();
        $this->assertEquals("d8dfd6ff-05f9-498d-bd68-9bec4425b89c", $extension->env("REDO_PHPUNIT_UUID"));
    }

    /**
     * @test
     * @return void
     */
    public function testFile(): void
    {
        $extension = new PropertiesTwigExtension();
        $this->assertEquals("foo", $extension->file(__DIR__ . "/resources/foo.txt"));
    }
}
