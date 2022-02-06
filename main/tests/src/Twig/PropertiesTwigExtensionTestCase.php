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
}
